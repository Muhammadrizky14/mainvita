@extends('layouts.admin')

@section('judul-halaman', 'Chat Management')

@section('content')
<style>
/* Scrollbar style */
#conversations-list::-webkit-scrollbar,
#chat-messages::-webkit-scrollbar {
    width: 8px;
    background: #e3eefe;
}
#conversations-list::-webkit-scrollbar-thumb,
#chat-messages::-webkit-scrollbar-thumb {
    background: #b5d1f7;
    border-radius: 8px;
}

/* Card style */
.chat-card {
    border-radius: 1.1rem;
    border: 2px solid #c9dcf6;
    background: #fff;
    transition: border-color 0.18s, background 0.18s;
}
.chat-card.selected, .chat-card:hover {
    background: #eaf3ff;
    border: 2px solid #4c8edc;
}
.chat-filter-btn {
    border: none;
    background: #eaf3ff;
    color: #1750a2;
    font-weight: 500;
    padding: 0.5rem 1.2rem;
    border-radius: 0.75rem;
    transition: background 0.16s, color 0.16s;
}
.chat-filter-btn.active, .chat-filter-btn:hover {
    background: #1750a2;
    color: #fff;
}

/* Bubble chat */
.chat-bubble {
    border-radius: 1rem;
    padding: 0.7rem 1.2rem 0.6rem 1.2rem;
    font-size: 1rem;
    max-width: 72%;
    word-break: break-word;
    margin-bottom: 0.35rem;
    border: none;
    box-shadow: 0 1px 6px 0 #b5d1f722;
    display: flex;
    flex-direction: column;
}
.chat-bubble.user {
    background: #fff;
    color: #23272b;
    margin-right: auto;
}
.chat-bubble.admin {
    background: #1750a2;
    color: #fff;
    margin-left: auto;
}
.chat-bubble.ai {
    background: #e6f9ed;
    color: #1e7c4a;
    margin-left: auto;
    margin-right: auto;
    border: 1.5px dashed #30c04f;
}
.chat-time {
    font-size: .88em;
    color: #6b7ca1;
    margin-bottom: 0.18em;
    font-weight: 500;
}
.chat-bubble.admin .chat-time {
    color: #b5d1f7;
}
.chat-bubble.user .chat-time {
    color: #6b7ca1;
}
.chat-bubble.ai .chat-time {
    color: #30c04f;
}

/* Header Action Button Floating Bottom Right */
.chat-header-action {
    position: absolute;
    right: 2.5rem;
    bottom: 1.6rem;
    display: flex;
    gap: 0.5rem;
    z-index: 10;
}
@media (max-width: 1023px) {
    .px-10 {padding-left:1.2rem !important;padding-right:1.2rem !important;}
    .py-8 {padding-top:1.2rem !important;padding-bottom:1.2rem !important;}
    .chat-header-action { right: 1rem; bottom: 1rem; }
}
.btn-action {
    min-width: 82px;
    font-weight: 600;
    box-shadow: 0 2px 8px 0 #b5d1f755;
    border: none;
    outline: none;
    transition: background 0.13s, color 0.13s;
}
.btn-close {
    background: #e74c3c;
    color: #fff;
    border-radius: .7rem;
}
.btn-close:hover {
    background: #b82e1f;
}
.btn-reopen {
    background: #27ae60;
    color: #fff;
    border-radius: .7rem;
}
.btn-reopen:hover {
    background: #168d3b;
}
</style>
<div class="flex h-[calc(100vh-100px)] bg-[#daeaff] rounded-xl overflow-hidden shadow">
    <!-- Conversations List -->
    <div class="w-1/3 border-r border-[#c9dcf6] h-full flex flex-col bg-[#daeaff]">
        <div class="px-8 py-6 bg-[#daeaff] border-b border-[#c9dcf6]">
            <h2 class="text-xl font-bold text-[#23272b] mb-1">Conversations</h2>
            <div class="mt-2 flex gap-2">
                <button id="filter-all" class="chat-filter-btn active" type="button">All</button>
                <button id="filter-active" class="chat-filter-btn" type="button">Active</button>
                <button id="filter-closed" class="chat-filter-btn" type="button">Closed</button>
            </div>
        </div>
        <div id="conversations-list" class="flex-1 overflow-y-auto bg-[#daeaff] px-5 py-4">
            <div class="p-4 text-center text-[#9bb2d8] text-sm animate-pulse">
                Loading conversations...
            </div>
        </div>
    </div>
    <!-- Chat Area -->
    <div class="w-2/3 flex flex-col bg-[#daeaff] h-full">
        <!-- header dan tombol close/reopen fixed di kanan bawah header -->
        <div id="chat-header" class="px-10 py-6 bg-white border-b border-[#c9dcf6] flex items-start rounded-tr-xl shadow-sm relative" style="min-height:90px;">
            <div>
                <h2 class="text-lg font-bold text-[#23272b] mb-1" id="chat-user-name">Select a conversation</h2>
                <p class="text-xs text-[#4c8edc] font-medium" id="chat-category"></p>
            </div>
            <div class="chat-header-action">
                <button id="close-conversation" class="btn-action btn-close hidden">Close</button>
                <button id="reopen-conversation" class="btn-action btn-reopen hidden">Reopen</button>
            </div>
        </div>
        <div id="chat-messages" class="flex-1 overflow-y-auto px-10 py-8 space-y-3 bg-[#daeaff]" style="min-height:0">
            <div class="text-center text-[#9bb2d8] mt-12 text-sm">
                Select a conversation to view messages
            </div>
        </div>
        <div id="chat-input-container" class="px-10 py-5 border-t border-[#c9dcf6] bg-[#daeaff]">
            <form id="chat-form" class="flex items-center gap-2">
                <input type="text" id="chat-input" class="flex-1 border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1750a2] bg-white text-[#23272b] placeholder-[#9bb2d8] text-base" placeholder="Type your message..." disabled>
                <button type="submit" class="bg-[#1750a2] text-white rounded-lg px-6 py-3 font-semibold hover:bg-[#2465c8] transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const conversationsList = document.getElementById('conversations-list');
    const chatMessages = document.getElementById('chat-messages');
    const chatUserName = document.getElementById('chat-user-name');
    const chatCategory = document.getElementById('chat-category');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const closeConversationBtn = document.getElementById('close-conversation');
    const reopenConversationBtn = document.getElementById('reopen-conversation');
    const filterAllBtn = document.getElementById('filter-all');
    const filterActiveBtn = document.getElementById('filter-active');
    const filterClosedBtn = document.getElementById('filter-closed');

    let currentConversation = null;
    let conversations = [];
    let currentFilter = 'all';
    let refreshInterval;

    loadConversations();
    refreshInterval = setInterval(loadConversations, 30000);

    function updateFilterBtnStyle() {
        document.querySelectorAll('.chat-filter-btn').forEach(btn => btn.classList.remove('active'));
        if (currentFilter === 'all') filterAllBtn.classList.add('active');
        if (currentFilter === 'active') filterActiveBtn.classList.add('active');
        if (currentFilter === 'closed') filterClosedBtn.classList.add('active');
    }

    filterAllBtn.addEventListener('click', function() { setFilter('all'); });
    filterActiveBtn.addEventListener('click', function() { setFilter('active'); });
    filterClosedBtn.addEventListener('click', function() { setFilter('closed'); });

    closeConversationBtn.addEventListener('click', function() {
        if (!currentConversation) return;
        fetch(`/admin/chat/conversations/${currentConversation.id}/close`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) throw new Error(data.error);
            if (data.success) {
                currentConversation.status = 'closed';
                updateConversationUI();
                loadConversations();
            }
        }).catch(error => alert('Error closing conversation: ' + error.message));
    });

    reopenConversationBtn.addEventListener('click', function() {
        if (!currentConversation) return;
        fetch(`/admin/chat/conversations/${currentConversation.id}/reopen`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) throw new Error(data.error);
            if (data.success) {
                currentConversation.status = 'active';
                updateConversationUI();
                loadConversations();
            }
        }).catch(error => alert('Error reopening conversation: ' + error.message));
    });

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!currentConversation) return;
        const message = chatInput.value.trim();
        if (!message) return;
        chatInput.value = '';
        fetch(`/admin/chat/conversations/${currentConversation.id}/send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) throw new Error(data.error);
            addMessage(data);
            scrollToBottom();
        })
        .catch(error => {
            const errorMsg = document.createElement('div');
            errorMsg.className = 'text-center text-red-500 my-2';
            errorMsg.textContent = `Error sending message: ${error.message}`;
            chatMessages.appendChild(errorMsg);
        });
    });

    function loadConversations() {
        fetch('/admin/chat/conversations', {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) throw new Error(data.error);
            conversations = data;
            renderConversations();
        })
        .catch(error => {
            conversationsList.innerHTML = `<div class="p-4 text-center text-red-500">Error loading conversations: ${error.message}</div>`;
        });
    }

    function loadConversation(conversationId) {
        fetch(`/admin/chat/conversations/${conversationId}`, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) throw new Error(data.error);
            currentConversation = data;
            renderConversation();
        })
        .catch(error => {
            chatMessages.innerHTML = `<div class="text-center text-red-500">Error loading conversation: ${error.message}</div>`;
        });
    }

    function renderConversations() {
        if (conversations.length === 0) {
            conversationsList.innerHTML = '<div class="p-4 text-center text-[#9bb2d8]">No conversations found</div>';
            return;
        }
        conversationsList.innerHTML = '';
        conversations
            .filter(conversation => currentFilter === 'all' || conversation.status === currentFilter)
            .forEach(conversation => {
                const conversationEl = document.createElement('div');
                conversationEl.className = `chat-card p-5 mb-4 cursor-pointer flex flex-col gap-2${currentConversation && currentConversation.id === conversation.id ? ' selected' : ''}`;
                conversationEl.dataset.id = conversation.id;
                const date = new Date(conversation.updated_at);
                const formattedDate = date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const latestMessage = conversation.latest_message ?
                    (conversation.latest_message.message.length > 30 ?
                        conversation.latest_message.message.substring(0, 30) + '...' :
                        conversation.latest_message.message) :
                    'No messages';
                conversationEl.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-[#23272b]">${conversation.user ? escapeHtml(conversation.user.name) : 'Unknown User'}</h3>
                            <p class="text-sm text-[#3a4861]">${escapeHtml(latestMessage)}</p>
                        </div>
                        <div class="flex flex-col gap-1 items-end">
                            <span class="text-xs text-[#6b7ca1] font-semibold">${formattedDate}</span>
                            ${conversation.unread_count > 0 ? `<span class="bg-[#f36464] text-white text-xs rounded-full px-2 py-1">${conversation.unread_count}</span>` : ''}
                            ${conversation.status === 'closed' ? '<span class="block text-xs bg-[#e3eefe] text-[#6b7ca1] rounded px-2 py-1">Closed</span>' : ''}
                        </div>
                    </div>
                    ${conversation.category ? `<div class="text-xs bg-[#e3eefe] text-[#1750a2] inline-block rounded px-2 py-1 font-semibold">${conversation.category}</div>` : ''}
                `;
                conversationEl.addEventListener('click', function() {
                    loadConversation(conversation.id);
                });
                conversationsList.appendChild(conversationEl);
            });
        updateFilterBtnStyle();
    }

    function renderConversation() {
        chatUserName.textContent = currentConversation.user ? currentConversation.user.name : 'Unknown User';
        chatCategory.textContent = currentConversation.category ? `Category: ${currentConversation.category}` : '';
        chatMessages.innerHTML = '';
        currentConversation.messages.forEach(message => {
            addMessage(message, false);
        });
        updateConversationUI();
        scrollToBottom();
        document.querySelectorAll('#conversations-list > div').forEach(el => {
            if (el.dataset.id == currentConversation.id) {
                el.classList.add('selected');
            } else {
                el.classList.remove('selected');
            }
        });
    }

    function updateConversationUI() {
        if (currentConversation.status === 'active') {
            chatInput.disabled = false;
            chatForm.querySelector('button').disabled = false;
            closeConversationBtn.classList.remove('hidden');
            reopenConversationBtn.classList.add('hidden');
        } else {
            chatInput.disabled = true;
            chatForm.querySelector('button').disabled = true;
            closeConversationBtn.classList.add('hidden');
            reopenConversationBtn.classList.remove('hidden');
        }
    }

    function addMessage(message, scroll = true) {
        const messageEl = document.createElement('div');
        let bubbleClass = 'chat-bubble';
        if (message.sender_type === 'user') bubbleClass += ' user';
        else if (message.sender_type === 'admin') bubbleClass += ' admin';
        else if (message.sender_type === 'ai') bubbleClass += ' ai';
        let align = 'flex justify-start';
        if (message.sender_type === 'admin') align = 'flex justify-end';
        else if (message.sender_type === 'ai') align = 'flex justify-center';
        messageEl.className = align;
        messageEl.innerHTML = `
            <div class="${bubbleClass}">
                <div class="chat-time">${formatMessageTime(message.created_at)}</div>
                <div>${escapeHtml(message.message)}</div>
            </div>
        `;
        chatMessages.appendChild(messageEl);
        if (scroll) scrollToBottom();
    }

    function formatMessageTime(timestamp) {
        if (!timestamp) return '';
        const date = new Date(timestamp);
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    function setFilter(filter) {
        currentFilter = filter;
        renderConversations();
    }
    function escapeHtml(unsafe) {
        if (!unsafe) return '';
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
});
</script>
@endsection