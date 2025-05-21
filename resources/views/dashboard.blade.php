<x-app-layout>
    <!-- Add this near the top of your dashboard.blade.php file -->
    <!-- This section will only be visible to authenticated users -->
    @auth
        <!-- Your authenticated user content here -->
    @endauth

    <!-- This section will be visible to everyone -->
    @guest
        <!-- Your non-authenticated user content here -->
        <!-- You might want to add a login prompt or limited content -->
    @endguest
    {{-- halaman 1 --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal mt-8">
        <div class="pt-1">
            <div class="container flex items-center justify-center">
                <div class="flex flex-row items-center justify-between w-full">
                    <div class="w-1/2 text-left pl-2 sm:pl-4 md:pl-6 lg:pl-8 xl:pl-10 pr-2 sm:pr-4">
                        <p class="uppercase tracking-loose text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl">
                            Skip the Travel! Take Online
                        </p>
                        <h1
                            class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold leading-tight mt-1 mb-2">
                            Welcome <span class="text-blue-300">Vitalife</span>
                        </h1>
                        <div class="mb-2 sm:mb-4">
                            <p
                                class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl h-12 sm:h-16 md:h-20 lg:h-24 xl:h-28 overflow-hidden">
                                <span id="typed-text"></span>
                                <span class="typed-cursor animate-blink">|</span>
                            </p>
                        </div>
                        <button id="consultNowBtn" class="bg-blue-500 text-white font-bold rounded-full py-1 px-3 sm:py-2 sm:px-4 md:py-2.5 md:px-5 lg:py-3 lg:px-6 xl:py-4 xl:px-8 shadow-lg 
                    transform transition duration-300 ease-in-out
                    hover:scale-105 hover:bg-blue-600 hover:shadow-xl
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <span
                                class="inline-block transform group-hover:translate-x-1 transition-transform duration-200 text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl">
                                Consult Now
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3 sm:h-4 sm:w-4 md:h-5 md:w-5 lg:h-6 lg:w-6 xl:h-7 xl:w-7 inline-block ml-1 transform group-hover:translate-x-1 transition-transform duration-200"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="w-1/2 flex justify-end">
                        <div class="rounded-lg overflow-hidden">
                            <img class="w-full h-auto object-cover" src="../image/bgdash.png"
                                alt="Dashboard Background" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- halaman 2 --}}

    <div id="features"
        class="bg-white rounded-lg shadow-md p-3 sm:p-4 md:p-5 text-center flex flex-col items-center reveal">
        <h2 class="text-2xl sm:text-3xl font-bold mb-5 sm:mb-7 md:mb-9">Wellness Support</h2>
        <div class="flex flex-wrap justify-center gap-10 sm:gap-14 md:gap-20 lg:gap-28">
            <a href="/spa" class="flex-shrink-0 transform transition duration-300 hover:scale-105 group mb-5 sm:mb-7">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/spa.png" alt="spa" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">SPA</p>
                </div>
            </a>

            <a href="/yoga" class="flex-shrink-0 transform transition duration-300 hover:scale-105 group mb-5 sm:mb-7">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/meditation.png" alt="Meditation" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">YOGA</p>
                </div>
            </a>

            <a href="/event" class="flex-shrink-0 transform transition duration-300 hover:scale-105 group mb-5 sm:mb-7">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/run.png" alt="event" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">EVENT</p>
                </div>
            </a>
        </div>
    </div>

    {{-- halaman 3 --}}
    <div id="spesialis" class="p-5 sm:p-8 md:p-10 text-center flex flex-col items-center reveal">
        <h2 class="text-2xl sm:text-3xl font-bold mb-10 sm:mb-12 text-navy-blue">Specialization</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 sm:gap-10">
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Anatomy" id="anatomy" name="anatomy"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/anatomy.png" alt="Anatomy" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Anatomy</p>
                </div>
            </a>
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Primary Care" id="Primary Care" name="Primary Care"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/care.png" alt="Primary Care" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Primary Care</p>
                </div>
            </a>
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Cardiology" id="cardiology" name="cardiology"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/cardiology.png" alt="Cardiology" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Cardiology</p>
                </div>
            </a>
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Skin Genitals" id="skinGenitals" name="specialization"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/skin.png" alt="Skin & Genitals" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Skin & Genitals</p>
                </div>
            </a>
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Human Senses" id="humanSenses" name="specialization"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/human.png" alt="Human Senses" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Human Senses</p>
                </div>
            </a>
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Piscologist" id="piscologist" name="specialization"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/psico.png" alt="Piscologist" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Piscologist</p>
                </div>
            </a>
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Physiotherapi" id="fisioterapy" name="specialization"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/fisio.png" alt="Fisioterapy" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Fisioterapy</p>
                </div>
            </a>
            <a href="{{ route('spesialisFilter') }}?spesialisasi=Pregnancy" id="pregnancy" name="specialization"
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 group">
                <div class="relative p-3 sm:p-4 md:p-5 group-hover:shadow-md rounded-lg group-hover:border-gray-500">
                    <img src="../image/preg.png" alt="Pregnancy" class="h-14 sm:h-16 md:h-20 mb-3 sm:mb-4" />
                    <p class="text-sm sm:text-base font-bold">Pregnancy</p>
                </div>
            </a>
        </div>
    </div>

    {{-- halaman 4 voucher --}}
    <section id="voucher" class="py-2 md:py-5 bg-white text-zinc-900 dark:text-white z-10 reveal">
        <div class="container px-10 mx-auto">
            <div class="relative" x-data="imageSlider()">
                <div id="imageSlider" class="overflow-hidden relative">
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="{ transform: `translateX(-${currentIndex * (100/3)}%)` }">
                        @foreach ($vouchers as $voucher)
                        <div class="w-1/3 flex-shrink-0 px-3">
                            <img class="w-full rounded-xl cursor-pointer" src="{{ asset($voucher->image) }}"
                                alt="{{ $voucher->description }}"
                                onclick="openPopup('{{ asset($voucher->image) }}', '{{ $voucher->description }}', '{{ $voucher->code }}')" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popup -->
    <div id="popup"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto relative">
            <button onclick="closePopup()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <img id="popupImage" src="/placeholder.svg" alt="" class="w-full rounded-xl mb-4">
            <p id="popupDescription" class="text-gray-700 mb-4"></p>
            <div class="border border-gray-300 rounded-md p-3 mb-4 inline-block">
                <p class="font-bold text-lg" id="voucherCode"></p>
            </div>
        </div>
    </div>

    <section class="bg-blue-50 p-4 sm:p-8 md:p-12 lg:p-16 reveal">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-4">
            <div class="flex md:flex-row justify-between items-start">
                <div class="flex-1 md:w-1/2 mb-8 md:mb-0">
                    <p class="text-blue-500 uppercase text-sm font-semibold mb-2">CARING FOR THE HEALTH OF YOU AND YOUR
                        FAMILY.</p>
                    <h2 class="text-3xl font-bold text-navy-800 mb-4">Our Families</h2>
                    <p class="text-gray-600 mb-4">
                        We will work with you to develop individualised care plans, including management of chronic
                        diseases. If we cannot assist, we can provide referrals or advice about the type of practitioner
                        you require. We treat all enquiries sensitively and in the strictest confidence.
                    </p>
                </div>
                <div class=" flex-col md:w-1/2 grid grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center">
                        <div class="bg-blue-100 p-3 rounded-full mb-4">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 id="counter1" class="text-3xl font-bold text-navy-800 mb-2">0</h3>
                        <p class="text-gray-500">Happy Patients</p>
                    </div>
                    <div class="bg-white p-6 mt-12 rounded-lg shadow-sm flex flex-col items-center">
                        <div class="bg-red-100 p-3 rounded-full mb-4">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h3 id="counter2" class="text-3xl font-bold text-navy-800 mb-2">0</h3>
                        <p class="text-gray-500">Hospitals</p>
                    </div>
                    <div class="bg-white p-6 mb-12 rounded-lg shadow-sm flex flex-col items-center">
                        <div class="bg-yellow-100 p-3 rounded-full mb-4">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"></path>
                            </svg>
                        </div>
                        <h3 id="counter3" class="text-3xl font-bold text-navy-800 mb-2">0</h3>
                        <p class="text-gray-500">Laboratories</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center">
                        <div class="bg-green-100 p-3 rounded-full mb-4">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 id="counter4" class="text-3xl font-bold text-navy-800 mb-2">0</h3>
                        <p class="text-gray-500">Expert Doctors</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Chatbot Widget -->
<div id="chatbot-widget" class="fixed bottom-4 right-4 z-50">
    <!-- Chat Button -->
    <button id="chat-button" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full p-4 shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chat Window -->
    <div id="chat-window" class="hidden bg-white rounded-lg shadow-xl w-80 sm:w-96 h-96 flex flex-col overflow-hidden">
        <!-- Chat Header -->
        <div class="bg-blue-500 text-white p-4 flex justify-between items-center">
            <h3 class="font-bold">Vitalife Support</h3>
            <div class="flex space-x-2">
                <button id="minimize-chat" class="hover:bg-blue-600 rounded p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4"></div>

        <!-- Category Selection (initially visible) -->
        <div id="category-selection" class="p-4 bg-gray-50">
            <p class="text-sm text-gray-600 mb-2">What would you like to discuss?</p>
            <div class="grid grid-cols-2 gap-2">
                <button class="category-btn bg-white border border-gray-300 rounded p-2 text-sm hover:bg-gray-100 transition-colors" data-category="Facilities & Accommodations">Facilities & Accommodations</button>
                <button class="category-btn bg-white border border-gray-300 rounded p-2 text-sm hover:bg-gray-100 transition-colors" data-category="Health & Security">Health & Security</button>
                <button class="category-btn bg-white border border-gray-300 rounded p-2 text-sm hover:bg-gray-100 transition-colors" data-category="Cancellations & Refunds">Cancellations & Refunds</button>
                <button class="category-btn bg-white border border-gray-300 rounded p-2 text-sm hover:bg-gray-100 transition-colors" data-category="Payments & Promotions">Payments & Promotions</button>
            </div>
        </div>

        <!-- Chat Input (initially hidden) -->
        <div id="chat-input-container" class="p-4 border-t hidden">
            <form id="chat-form" class="flex space-x-2">
                <input type="text" id="chat-input" class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message...">
                <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Chat JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const chatButton = document.getElementById('chat-button');
    const chatWindow = document.getElementById('chat-window');
    const minimizeChat = document.getElementById('minimize-chat');
    const chatMessages = document.getElementById('chat-messages');
    const categorySelection = document.getElementById('category-selection');
    const categoryButtons = document.querySelectorAll('.category-btn');
    const chatInputContainer = document.getElementById('chat-input-container');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    
    // State
    let currentConversation = null;
    let selectedCategory = null;
    
    // Toggle chat window
    chatButton.addEventListener('click', function() {
        chatWindow.classList.toggle('hidden');
        chatButton.classList.toggle('hidden');
        
        if (!chatWindow.classList.contains('hidden') && currentConversation === null) {
            // First time opening, check for existing conversation
            fetchConversation();
        }
    });
    
    // Minimize chat
    minimizeChat.addEventListener('click', function() {
        chatWindow.classList.add('hidden');
        chatButton.classList.remove('hidden');
    });
    
    // Category selection
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            selectedCategory = this.dataset.category;
            categorySelection.classList.add('hidden');
            chatInputContainer.classList.remove('hidden');
            
            // Add system message
            addSystemMessage(`You've selected: ${selectedCategory}. How can I help you today?`);
            
            // Update conversation with category if needed
            if (currentConversation) {
                updateConversationCategory(currentConversation.id, selectedCategory);
            }
        });
    });
    
    // Send message
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (!message) return;
        
        // Add user message to UI
        addUserMessage(message);
        chatInput.value = '';
        
        // Send message to server
        sendMessage(message);
    });
    
    // Fetch or create conversation
    function fetchConversation() {
        fetch('/chat/conversation', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            currentConversation = data.conversation;
            
            // If conversation has messages, display them
            if (data.messages && data.messages.length > 0) {
                chatMessages.innerHTML = '';
                data.messages.forEach(message => {
                    if (message.sender_type === 'user') {
                        addUserMessage(message.message, false);
                    } else if (message.sender_type === 'ai') {
                        addBotMessage(message.message, false);
                    } else if (message.sender_type === 'admin') {
                        addAdminMessage(message.message, false);
                    }
                });
                
                // If conversation has a category, skip category selection
                if (currentConversation.category) {
                    selectedCategory = currentConversation.category;
                    categorySelection.classList.add('hidden');
                    chatInputContainer.classList.remove('hidden');
                }
            }
            
            // Scroll to bottom
            scrollToBottom();
        })
        .catch(error => {
            console.error('Error fetching conversation:', error);
            addSystemMessage('There was an error connecting to the chat service. Please try again later.');
        });
    }
    
    // Update conversation category
    function updateConversationCategory(conversationId, category) {
        // This is handled when sending the first message
    }
    
    // Send message to server
    function sendMessage(message) {
        fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                conversation_id: currentConversation.id,
                message: message,
                category: selectedCategory
            })
        })
        .then(response => response.json())
        .then(data => {
            // If AI responded, add the response
            if (data.ai_response) {
                addBotMessage(data.ai_response.message);
            } else {
                // Add a waiting message
                addSystemMessage('An admin will respond to your message soon.');
            }
        })
        .catch(error => {
            console.error('Error sending message:', error);
            addSystemMessage('There was an error sending your message. Please try again.');
        });
    }
    
    // Add user message to UI
    function addUserMessage(message, scroll = true) {
        const messageElement = document.createElement('div');
        messageElement.className = 'flex justify-end';
        messageElement.innerHTML = `
            <div class="bg-blue-500 text-white rounded-lg py-2 px-4 max-w-[80%]">
                <p>${escapeHtml(message)}</p>
            </div>
        `;
        chatMessages.appendChild(messageElement);
        if (scroll) scrollToBottom();
    }
    
    // Add bot message to UI
    function addBotMessage(message, scroll = true) {
        const messageElement = document.createElement('div');
        messageElement.className = 'flex justify-start';
        messageElement.innerHTML = `
            <div class="bg-gray-200 rounded-lg py-2 px-4 max-w-[80%]">
                <p class="text-gray-800">${escapeHtml(message)}</p>
            </div>
        `;
        chatMessages.appendChild(messageElement);
        if (scroll) scrollToBottom();
    }
    
    // Add admin message to UI
    function addAdminMessage(message, scroll = true) {
        const messageElement = document.createElement('div');
        messageElement.className = 'flex justify-start';
        messageElement.innerHTML = `
            <div class="bg-green-100 rounded-lg py-2 px-4 max-w-[80%]">
                <p class="text-gray-800"><span class="font-bold text-green-600">Admin:</span> ${escapeHtml(message)}</p>
            </div>
        `;
        chatMessages.appendChild(messageElement);
        if (scroll) scrollToBottom();
    }
    
    // Add system message to UI
    function addSystemMessage(message, scroll = true) {
        const messageElement = document.createElement('div');
        messageElement.className = 'flex justify-center';
        messageElement.innerHTML = `
            <div class="bg-gray-100 text-gray-600 rounded-lg py-2 px-4 text-sm max-w-[90%] text-center">
                <p>${escapeHtml(message)}</p>
            </div>
        `;
        chatMessages.appendChild(messageElement);
        if (scroll) scrollToBottom();
    }
    
    // Scroll chat to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Escape HTML to prevent XSS
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
});
</script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const consultNowBtn = document.getElementById('consultNowBtn');
        const spesialisSection = document.getElementById('spesialis');

        consultNowBtn.addEventListener('click', function(e) {
            e.preventDefault();
            spesialisSection.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // POP Up
    function openPopup(imageSrc, description, voucherCode) {
        const popup = document.getElementById('popup');
        const popupImage = document.getElementById('popupImage');
        const popupDescription = document.getElementById('popupDescription');
        const voucherCodeElement = document.getElementById('voucherCode');

        popupImage.src = `../image/${imageSrc}`;
        popupDescription.textContent = description;
        voucherCodeElement.textContent = voucherCode;
        popup.classList.remove('hidden');
    }

    function closePopup() {
        const popup = document.getElementById('popup');
        popup.classList.add('hidden');
    }

    function imageSlider() {
        return {
            currentIndex: 0,
            totalSlides: 7, // Jumlah total gambar
            nextSlide() {
                this.currentIndex = (this.currentIndex + 1) % (this.totalSlides - 2);
            },
            startSlider() {
                setInterval(() => this.nextSlide(), 3000);
            },
            init() {
                this.startSlider();
            }
        }
    }

    // Fungsi untuk menampilkan loading
    function showLoading() {
        return Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            },
            background: '#f8f9fa',
            customClass: {
                title: 'text-lg font-semibold text-gray-800',
                content: 'text-sm text-gray-600'
            },
            timer: 10000, // Timeout setelah 10 detik
            timerProgressBar: true
        });
    }

    // Fungsi untuk menyembunyikan loading
    function hideLoading() {
        Swal.close();
    }

    // Tampilkan loading saat halaman dimuat
    window.addEventListener('load', function() {
        const loadingPromise = showLoading();
        // Sembunyikan loading setelah halaman selesai dimuat
        Promise.all([
            new Promise(resolve => setTimeout(resolve, 500)), // Minimal delay
            loadingPromise
        ]).then(hideLoading);
    });

    // Tampilkan loading saat berpindah halaman
    document.addEventListener('click', function(e) {
        const target = e.target.closest('a');
        if (target &&
            !target.getAttribute('download') &&
            target.href &&
            !target.href.startsWith('#') &&
            !e.ctrlKey &&
            !e.metaKey &&
            target.hostname === window.location.hostname) { // Hanya untuk link internal

            e.preventDefault();
            showLoading();
            setTimeout(() => {
                window.location = target.href;
            }, 300); // Waktu delay dikurangi untuk responsivitas lebih baik
        }
    });

    // Tambahkan event listener untuk menyembunyikan loading saat pengguna menekan tombol kembali
    window.addEventListener('popstate', hideLoading);

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const scroll = urlParams.get('scroll');
        if (scroll === 'voucher') {
            const voucherSection = document.getElementById('voucher');
            if (voucherSection) {
                voucherSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    });
    </script>
    @include('layouts.footer')
</x-app-layout>
