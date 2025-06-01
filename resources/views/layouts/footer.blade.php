<footer>
    <!-- FAQ Section -->
    <section class="py-12 reveal bg-gray-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
                <p class="text-blue-500 text-sm font-medium mb-4">Get Your Answer</p>
                <h2 class="text-3xl font-bold text-[#1e3a8a]">Frequently Asked Questions</h2>
            </div>
            <div class="flex flex-col md:flex-row items-start gap-8">
                <!-- Image -->
                <div class="md:w-1/2 w-full relative">
                    <img src="../image/gabungan.png" alt="Doctor with patient"
                        class="w-full rounded-lg shadow-lg" />
                    <div class="absolute bottom-4 left-4 flex items-center bg-white rounded-full px-4 py-2 shadow-md">
                        <span class="text-2xl mr-3">😊</span>
                        <p class="font-semibold text-sm">84k+ <span class="font-normal text-gray-600">Happy
                                Patients</span>
                        </p>
                    </div>
                </div>

                <!-- FAQ Content -->
                <div class="md:w-1/2 w-full pt-0" x-data="{ openItem: null }">
                    <div class="space-y-3">
                        <!-- FAQ Item 1 -->
                        <div class="border-b pb-3">
                            <button @click="openItem = openItem === 1 ? null : 1"
                                class="flex justify-between items-center w-full text-left">
                                <span class="font-medium text-[#1e3a8a] flex-grow pr-3">
                                    Why do you prefer Vitalife compared to other wellness tourism platforms?
                                </span>
                                <svg class="w-6 h-6 flex-shrink-0 text-blue-500 transform transition-transform duration-200"
                                    :class="{ 'rotate-45': openItem === 1 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <div x-show="openItem === 1" x-transition
                                class="mt-3 text-gray-600 text-sm">
                                I prefer Vitalife because of its transparent pricing, helpful reviews, progress tracking,
                                and ease of booking consultations and activities.
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="border-b pb-3">
                            <button @click="openItem = openItem === 2 ? null : 2"
                                class="flex justify-between items-center w-full text-left">
                                <span class="font-medium text-[#1e3a8a] flex-grow pr-3">
                                    What was your experience with the registration process and initial use of the Vitalife website?
                                </span>
                                <svg class="w-6 h-6 flex-shrink-0 text-blue-500 transform transition-transform duration-200"
                                    :class="{ 'rotate-45': openItem === 2 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <div x-show="openItem === 2" x-transition
                                class="mt-3 text-gray-600 text-sm">
                                The registration process was intuitive and user-friendly, making it easy to get started.
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="border-b pb-3">
                            <button @click="openItem = openItem === 3 ? null : 3"
                                class="flex justify-between items-center w-full text-left">
                                <span class="font-medium text-[#1e3a8a] flex-grow pr-3">
                                    What features appealed to you the most when you first saw the Vitalife website?
                                </span>
                                <svg class="w-6 h-6 flex-shrink-0 text-blue-500 transform transition-transform duration-200"
                                    :class="{ 'rotate-45': openItem === 3 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <div x-show="openItem === 3" x-transition
                                class="mt-3 text-gray-600 text-sm">
                                The online doctor consultation gave me confidence and peace of mind.
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="border-b pb-3">
                            <button @click="openItem = openItem === 4 ? null : 4"
                                class="flex justify-between items-center w-full text-left">
                                <span class="font-medium text-[#1e3a8a] flex-grow pr-3">
                                    How can Vitalife help you plan and enjoy your wellness journey?
                                </span>
                                <svg class="w-6 h-6 flex-shrink-0 text-blue-500 transform transition-transform duration-200"
                                    :class="{ 'rotate-45': openItem === 4 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <div x-show="openItem === 4" x-transition
                                class="mt-3 text-gray-600 text-sm">
                                Vitalife recommends facilities, packages, and events tailored to your wellness goals.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section class="py-16 bg-gray-800 text-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo and Description -->
                <div class="md:col-span-1">
                    <div class="flex items-center mb-6">
                        <img src="../image/LOGO_1.png" alt="Vitalife Logo" class="w-24 h-12 mr-3">
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        Merupakan sebuah organisasi non pemerintah yang mengangkat isu perawatan kesehatan untuk kualitas manajemen dan dari meningkatkan klip fisikum serta karayawan dalam.
                    </p>
                    <div>
                        <h4 class="font-semibold mb-4">Contact Us</h4>
                                                <h4 class="font-semibold mb-4">Contact Us</h4>
                        <div class="space-y-2 text-sm text-gray-300">

                        </div>
                    </div>
                </div>

                <!-- About Menu -->
                <div class="md:col-span-1">
                    <h4 class="font-semibold mb-6 text-lg">About</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Profile</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Visi & Misi</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Journey</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Value</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Playlist</a></li>
                    </ul>
                </div>

                <!-- Program Menu -->
                <div class="md:col-span-1">
                    <h4 class="font-semibold mb-6 text-lg">Program</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Manfaat Manajemen</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Commitment Fee</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Checkout</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Dokumentasi</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Open Donasi</a></li>
                    </ul>
                </div>

                <!-- Blog Menu -->
                <div class="md:col-span-1">
                    <h4 class="font-semibold mb-6 text-lg">Blog</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Galeri</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Help</a></li>
                    </ul>
                </div>
            </div>

            <!-- Partner Modal Section -->
            <div x-data="{ open: false }" class="mt-12 pt-8 border-t border-gray-600">
                <div class="text-center">
                    <p class="text-lg mb-4">If you are interested in becoming a partner, click the button below:</p>
                    <button @click="open = true"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 text-lg">
                        Join as a Partner
                    </button>
                </div>

                <!-- Modal -->
                <div x-show="open" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75" @click="open = false"></div>
                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full m-4">
                        <div class="bg-white px-6 pt-6 pb-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-5 text-center">Choose Partner Type</h3>
                            <div class="flex justify-around space-x-4">
                                <!-- Spa -->
                                <a href="#" class="flex-1 group">
                                    <div class="border rounded-lg p-4 text-center transform group-hover:scale-105 group-hover:shadow-lg">
                                        <img src="{{ asset('image/massage.png') }}" class="w-16 h-16 mx-auto mb-3">
                                        <p class="text-gray-800 font-semibold">Spa</p>
                                    </div>
                                </a>
                                <!-- Yoga -->
                                <a href="#" class="flex-1 group">
                                    <div class="border rounded-lg p-4 text-center transform group-hover:scale-105 group-hover:shadow-lg">
                                        <img src="{{ asset('image/lotus.png') }}" class="w-16 h-16 mx-auto mb-3">
                                        <p class="text-gray-800 font-semibold">Yoga</p>
                                    </div>
                                </a>
                                <!-- Event -->
                                <a href="#" class="flex-1 group">
                                    <div class="border rounded-lg p-4 text-center transform group-hover:scale-105 group-hover:shadow-lg">
                                        <img src="{{ asset('image/event-list.png') }}" class="w-16 h-16 mx-auto mb-3">
                                        <p class="text-gray-800 font-semibold">Event</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 flex justify-end">
                            <button @click="open = false"
                                class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-100">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="mt-12 pt-8 border-t border-gray-600">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <!-- Copyright -->
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-300">© All Right reserved | Owned by Vitalife</p>
                    </div>
                    
                    <!-- Social Media Links -->
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <span class="sr-only">Instagram</span>
                            Instagram
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <span class="sr-only">TikTok</span>
                            TikTok
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <span class="sr-only">YouTube</span>
                            YouTube
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <span class="sr-only">Facebook</span>
                            Facebook
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <span class="sr-only">LinkedIn</span>
                            LinkedIn
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <span class="sr-only">Twitter</span>
                            Twitter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>