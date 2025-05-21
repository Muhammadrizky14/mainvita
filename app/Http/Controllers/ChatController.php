<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use OpenAI;

class ChatController extends Controller
{
    /**
     * Get or create a conversation for the current user
     */
    public function getOrCreateConversation(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            
            // Find active conversation or create a new one
            $conversation = ChatConversation::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();
                
            if (!$conversation) {
                $conversation = ChatConversation::create([
                    'user_id' => $user->id,
                    'status' => 'active',
                    'category' => $request->category ?? null,
                ]);
            }
            
            return response()->json([
                'conversation' => $conversation,
                'messages' => $conversation->messages()->orderBy('created_at', 'asc')->get()
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getOrCreateConversation: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load conversation. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'conversation_id' => 'required|exists:chat_conversations,id',
                'message' => 'required|string',
            ]);
            
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            
            $conversation = ChatConversation::findOrFail($request->conversation_id);
            
            // Update category if provided
            if ($request->has('category') && $conversation->category === null) {
                $conversation->update(['category' => $request->category]);
            }
            
            // Create user message
            $message = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'user_id' => $user->id,
                'message' => $request->message,
                'sender_type' => 'user',
                'is_read' => false,
            ]);
            
            // Generate AI response if needed
            $aiResponse = null;
            if ($request->input('respond_with_ai', true)) {
                try {
                    $aiResponse = $this->generateAiResponse($conversation, $request->message);
                } catch (\Exception $e) {
                    \Log::error('AI Response Error: ' . $e->getMessage());
                    
                    $fallbackMessage = "I'm sorry, I couldn't process your request at the moment. An admin will assist you shortly.";
                    
                    $aiResponse = ChatMessage::create([
                        'conversation_id' => $conversation->id,
                        'message' => $fallbackMessage,
                        'sender_type' => 'ai',
                        'is_read' => true,
                    ]);
                }
            }
            
            return response()->json([
                'message' => $message,
                'ai_response' => $aiResponse
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in sendMessage: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send message. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Admin: Get all conversations
     */
    public function adminGetConversations()
    {
        try {
            // Check if user is admin
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
        
            $conversations = ChatConversation::with(['user'])
                ->orderBy('updated_at', 'desc')
                ->get();
                
            // Load latest message separately to avoid column name issues
            foreach ($conversations as $conversation) {
                $conversation->latest_message = ChatMessage::where('conversation_id', $conversation->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                $conversation->unread_count = ChatMessage::where('conversation_id', $conversation->id)
                    ->where('sender_type', 'user')
                    ->where('is_read', false)
                    ->count();
            }
                
            return response()->json($conversations);
        } catch (\Exception $e) {
            \Log::error('Error in adminGetConversations: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load conversations. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Admin: Get conversation messages
     */
    public function adminGetMessages($conversationId)
    {
        try {
            // Check if user is admin
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
        
            $conversation = ChatConversation::with(['user', 'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->findOrFail($conversationId);
            
            // Mark all user messages as read
            ChatMessage::where('conversation_id', $conversationId)
                ->where('sender_type', 'user')
                ->where('is_read', false)
                ->update(['is_read' => true]);
                
            return response()->json($conversation);
        } catch (\Exception $e) {
            \Log::error('Error in adminGetMessages: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load messages. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Admin: Send message
     */
    public function adminSendMessage(Request $request, $conversationId)
    {
        try {
            // Check if user is admin
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
        
            $request->validate([
                'message' => 'required|string',
            ]);
            
            $admin = Auth::user();
            $conversation = ChatConversation::findOrFail($conversationId);
            
            $message = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'admin_id' => $admin->id,
                'message' => $request->message,
                'sender_type' => 'admin',
                'is_read' => true,
            ]);
            
            // Update conversation timestamp
            $conversation->touch();
            
            return response()->json($message);
        } catch (\Exception $e) {
            \Log::error('Error in adminSendMessage: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send message. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Admin: Close conversation
     */
    public function adminCloseConversation($conversationId)
    {
        try {
            // Check if user is admin
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
        
            $conversation = ChatConversation::findOrFail($conversationId);
            $conversation->update(['status' => 'closed']);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error in adminCloseConversation: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to close conversation. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Admin: Reopen conversation
     */
    public function adminReopenConversation($conversationId)
    {
        try {
            // Check if user is admin
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
        
            $conversation = ChatConversation::findOrFail($conversationId);
            $conversation->update(['status' => 'active']);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error in adminReopenConversation: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to reopen conversation. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the admin chat interface
     */
    public function showAdminChat()
    {
        return view('admin.chat.index');
    }

    /**
     * Generate AI response
     */
    private function generateAiResponse($conversation, $userMessage)
    {
        try {
            // Check if OpenAI is configured
            if (empty(config('services.openai.api_key'))) {
                throw new \Exception('OpenAI API key not configured');
            }
            
            // Get conversation history for context
            $history = $conversation->messages()
                ->orderBy('created_at', 'asc')
                ->take(10)
                ->get()
                ->map(function ($msg) {
                    $role = $msg->sender_type === 'user' ? 'user' : 'assistant';
                    return ['role' => $role, 'content' => $msg->message];
                })
                ->toArray();
            
            // Add system message based on category
            $systemMessage = $this->getSystemMessageForCategory($conversation->category);
            
            // Prepare messages for OpenAI
            $messages = [
                ['role' => 'system', 'content' => $systemMessage],
                ...$history,
                ['role' => 'user', 'content' => $userMessage]
            ];
            
            try {
                // Try to call OpenAI API
                $response = OpenAI::chat()->create([
                    'model' => 'gpt-4-turbo',
                    'messages' => $messages,
                    'max_tokens' => 500,
                    'temperature' => 0.7,
                ]);
                
                $aiReply = $response->choices[0]->message->content;
            } catch (\Exception $e) {
                // If OpenAI fails, use a fallback response
                \Log::error('OpenAI API Error: ' . $e->getMessage());
                
                // Generate a simple fallback response based on the category
                $aiReply = $this->generateFallbackResponse($conversation->category, $userMessage);
            }
            
            // Save AI response to database
            $aiMessage = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'message' => $aiReply,
                'sender_type' => 'ai',
                'is_read' => true,
            ]);
            
            return $aiMessage;
            
        } catch (\Exception $e) {
            // Log error and return fallback message
            \Log::error('AI Response Error: ' . $e->getMessage());
            
            $fallbackMessage = "I'm sorry, I couldn't process your request at the moment. An admin will assist you shortly.";
            
            $aiMessage = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'message' => $fallbackMessage,
                'sender_type' => 'ai',
                'is_read' => true,
            ]);
            
            return $aiMessage;
        }
    }

    /**
     * Generate a fallback response when OpenAI is unavailable
     */
    private function generateFallbackResponse($category, $userMessage)
    {
        $userMessageLower = strtolower($userMessage);
        
        // Basic responses based on category
        switch ($category) {
            case 'Facilities & Accommodations':
                if (strpos($userMessageLower, 'spa') !== false) {
                    return "Our spa facilities include massage rooms, sauna, and relaxation areas. For more details, an admin will assist you shortly.";
                } elseif (strpos($userMessageLower, 'yoga') !== false) {
                    return "We offer yoga classes in our dedicated yoga studios. For schedules and bookings, an admin will assist you shortly.";
                } else {
                    return "We offer various facilities including spa, yoga studios, and event spaces. For specific details, an admin will assist you shortly.";
                }
            
            case 'Health & Security':
                return "Your health and security are our top priorities. We follow strict health protocols and have security measures in place. For specific inquiries, an admin will assist you shortly.";
            
            case 'Cancellations & Refunds':
                return "Our standard cancellation policy allows free cancellation up to 24 hours before your appointment. For specific details about your booking or refund process, an admin will assist you shortly.";
            
            case 'Payments & Promotions':
                if (strpos($userMessageLower, 'pesan') !== false || strpos($userMessageLower, 'order') !== false || strpos($userMessageLower, 'book') !== false) {
                    return "To make a booking, you can use our online booking system or contact us directly. For assistance with your specific booking needs, an admin will help you shortly.";
                } elseif (strpos($userMessageLower, 'promo') !== false || strpos($userMessageLower, 'discount') !== false) {
                    return "We regularly offer promotions and discounts. Check our voucher section for current offers. For more details, an admin will assist you shortly.";
                } else {
                    return "We accept various payment methods including credit cards and bank transfers. For current promotions or specific payment inquiries, an admin will assist you shortly.";
                }
            
            default:
                return "Thank you for your message. An admin will assist you shortly with your inquiry.";
        }
    }

    /**
     * Get system message for a conversation category
     */
    private function getSystemMessageForCategory($category)
    {
        // Define system messages based on category
        switch ($category) {
            case 'Facilities & Accommodations':
                return "You are now chatting about facilities and accommodations.";
            
            case 'Health & Security':
                return "You are now chatting about health and security.";
            
            case 'Cancellations & Refunds':
                return "You are now chatting about cancellations and refunds.";
            
            case 'Payments & Promotions':
                return "You are now chatting about payments and promotions.";
            
            default:
                return "You are now chatting in a general category.";
        }
    }
}
