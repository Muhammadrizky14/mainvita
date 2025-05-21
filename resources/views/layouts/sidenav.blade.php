<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <aside class="aside bg-black w-auto min-w-48 max-w-full px-4 fixed h-full flex flex-col">
        <!-- Fixed logo section -->
        <div class="py-4 sticky top-0 bg-black z-10">
            <div class="flex justify-start">
                <img src="../image/LOGO_1.png" alt="Logo" class="h-8 w-auto">
            </div>
        </div>

        <!-- Scrollable content -->
        <div class="flex-grow overflow-y-auto py-4 scrollbar-hide">
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="p-2 rounded-lg flex items-center {{ Request::routeIs('admin.dashboard') ? 'bg-white text-black' : 'text-white' }}">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- SPA Management Section -->
                <div class="space-y-2">
                    <a href="{{ route('admin.spas.index') }}"
                        class="p-2 rounded-lg flex items-center {{ Request::routeIs('admin.spas.*') ? 'bg-white text-black' : 'text-white' }}">
                        <i class="fa-solid fa-spa w-6 h-6"></i>
                        <span class="ml-2">SPA</span>
                    </a>

                    @if(Request::routeIs('admin.spas.*'))
                    <a href="{{ route('admin.spas.services.index', Request::segment(3) ?? 0) }}"
                        class="p-2 pl-10 rounded-lg flex items-center {{ Request::routeIs('admin.spas.services.*') ? 'bg-gray-700 text-white' : 'text-gray-400' }}">
                        <i class="fa-solid fa-list-check w-5 h-5"></i>
                        <span class="ml-2">Services</span>
                    </a>
                    @endif
                </div>

                <a href="{{ route('admin.yogas.index') }}"
                    class="p-2 rounded-lg mb-4 flex items-center {{ Request::routeIs('admin.yogas.index') ? 'bg-white text-black' : 'text-white' }}">
                    <i class="fa-solid fa-person-walking w-6 h-6"></i>
                    <span class="ml-2">Yoga</span>
                </a>

                <a href="{{ route('admin.spesialisis.index') }}"
                    class="p-2 rounded-lg mb-4 flex items-center {{ Request::routeIs('admin.spesialisis.index') ? 'bg-white text-black' : 'text-white' }}">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span class="ml-4">Spesialis</span>
                </a>

                <a href="{{ route('admin.event.index') }}"
                    class="p-2 rounded-lg mb-4 flex items-center {{ Request::routeIs('admin.event.index') ? 'bg-white text-black' : 'text-white' }}">
                    <i class="fa-solid fa-person-running"></i>
                    <span class="ml-4">Event</span>
                </a>

                <a href="{{ route('admin.accountuser') }}"
                    class="p-2 rounded-lg mb-4 flex items-center {{ Request::routeIs('admin.accountuser') ? 'bg-white text-black' : 'text-white' }}">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2">Account User</span>
                </a>

                <a href="{{ route('admin.feedback') }}"
                    class="p-2 rounded-lg mb-4 flex items-center {{ Request::routeIs('admin.feedback') ? 'bg-white text-black' : 'text-white' }}">
                    <svg class="w-6 h-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-6.616l-2.88 2.592C8.537 20.461 7 19.776 7 18.477V17H5a2 2 0 0 1-2-2V6Zm4 2a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2H7Zm8 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2Zm-8 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm5 0a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2h-5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2">Feedback User</span>
                </a>

                <a href="{{ route('admin.chat') }}"
                    class="p-2 rounded-lg mb-4 flex items-center {{ Request::routeIs('admin.chat') ? 'bg-white text-black' : 'text-white' }}">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-6.616l-2.88 2.592C8.537 20.461 7 19.776 7 18.477V17H5a2 2 0 0 1-2-2V6Z" />
                    </svg>
                    <span class="ml-2">Chat Messages</span>
                    <span id="unread-chat-count" class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 hidden">0</span>
                </a>

                <a href="{{ route('admin.vouchers.index') }}"
                    class="p-2 rounded-lg mb-4 flex items-center {{ Request::routeIs('admin.vouchers.index') ? 'bg-white text-black' : 'text-white' }}">
                    <i class="fa-duotone fa-solid fa-ticket"></i>
                    <span class="ml-4">Vouchers</span>
                </a>
            </nav>
        </div>

        <!-- Logout -->
        <div class="py-4 sticky bottom-0 bg-black">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full p-2 rounded-lg flex items-center text-gray-400 hover:text-white hover:bg-gray-700 transition-colors duration-200"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <svg class="w-6 h-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
</body>

</html>
