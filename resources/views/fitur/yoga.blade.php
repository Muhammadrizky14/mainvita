<x-app-layout>
    <div class="flex justify-center items-center pt-24">
        <div class="bg-gray-100 rounded-2xl shadow-lg w-full max-w-5xl p-8">
            <form action="{{ route('yoga.index') }}" method="GET">
                <div class="flex justify-between items-center mb-6 w-full">
                    <!-- Yoga Place Search -->
                    <div class="flex-grow mr-4">
                        <input type="text" name="yoga_place" id="yoga_place"
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600"
                            placeholder="Search for yoga places" value="{{ request('nama') }}" />
                    </div>

                    <!-- Search Button -->
                    <div>
                        <button type="submit"
                            class="bg-blue-600 text-white rounded-md py-1.5 px-6 text-sm hover:bg-blue-700 transition duration-300">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span class="text-sm">Search</span>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="flex flex-wrap justify-start items-center w-full gap-4">
                    <!-- Location Filter -->
                    <div class="w-64">
                        <select name="location" id="location"
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600">
                            <option value="">Select Location</option>
                            <option value="sleman" {{ request('location') == 'sleman' ? 'selected' : '' }}>Sleman
                            </option>
                            <option value="kota_yogyakarta"
                                {{ request('location') == 'kota_yogyakarta' ? 'selected' : '' }}>Kota Yogyakarta
                            </option>
                            <option value="bantul" {{ request('location') == 'bantul' ? 'selected' : '' }}>Bantul
                            </option>
                            <option value="kulon_progo" {{ request('location') == 'kulon_progo' ? 'selected' : '' }}>
                                Kulon Progo</option>
                            <option value="gunung_kidul" {{ request('location') == 'gunung_kidul' ? 'selected' : '' }}>
                                Gunung Kidul</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap justify-start items-center w-full gap-4">
                    <!-- Price range filter -->
                        <div class="flex justify-start items-center w-full space-x-4">
                            <label for="min-price" class="text-sm font-medium text-gray-700">Price Range:</label>
                            <input type="number" id="min-price" name="min_price"
                                class="rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600"
                                placeholder="Min" value="{{ request('min_price') }}" />
                            <span class="text-gray-500">-</span>
                            <input type="number" id="max-price" name="max_price"
                                class="rounded-md border-0 py-1.5 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600"
                                placeholder="Max" value="{{ request('max_price') }}" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Yoga Listings Section with Side-by-Side Layout -->
    <div class="flex justify-center items-start px-4 mt-6">
        <div class="font-sans w-full max-w-5xl">
            @foreach ($yogaTotal as $yoga)
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <!-- Yoga Details Card - Left Side -->
                    <div class="bg-white rounded-lg shadow-2xl p-6 flex-1">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 mr-6 overflow-hidden flex-shrink-0">
                                <img src="{{ asset($yoga->image) }}" alt="yoga"
                                    class="object-cover w-full h-full">
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold">{{ $yoga->nama }}</h2>
                                <p class="text-gray-500 text-lg">Relaxation</p>
                                <p class="text-gray-500 text-lg">16 years experience overall</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-6">
                            <p class="text-gray-500 text-lg mb-3">Alamat: {{ $yoga->alamat }}</p>
                            <p class="text-gray-500 text-lg mb-3">No. HP: {{ $yoga->noHP }}</p>
                            <p class="text-gray-500 text-lg mb-6">Harga: Rp {{ number_format($yoga->harga, 0, ',', '.') }}</p>
                            
                            <div class="mt-4">
                                <button
                                    class="scheduleBtn bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded">
                                    Schedule
                                </button>
                            </div>

                            <!-- Available -->
                            <div class="scheduleInfo mt-8 hidden">
                                <h3 class="text-xl font-bold mb-4">Waktu Buka</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                        @if(isset($yoga->waktuBuka[$hari]) && !empty($yoga->waktuBuka[$hari]))
                                            <div class="text-center bg-gray-50 p-3 rounded-lg">
                                                <p class="text-base font-semibold text-gray-700">{{ $hari }}</p>
                                                <p class="text-sm text-gray-500">{{ $yoga->waktuBuka[$hari] }}</p>
                                            </div>
                                        @else
                                            <div class="text-center bg-gray-50 p-3 rounded-lg">
                                                <p class="text-base font-semibold text-gray-700">{{ $hari }}</p>
                                                <p class="text-sm text-gray-500">Tutup</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Maps Section - Right Side with increased height -->
                    <div class="bg-blue-50 rounded-lg p-4 md:w-1/3 flex flex-col">
                        <h2 class="text-2xl font-bold mb-4">Lokasi Maps</h2>
                        <div id="map-{{$yoga->id_yoga}}" class="w-full h-96 md:h-[500px] bg-gray-200 rounded-lg flex-grow"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scheduleBtns = document.querySelectorAll('.scheduleBtn');

        scheduleBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const scheduleInfo = this.closest('.bg-white').querySelector('.scheduleInfo');
                scheduleInfo.classList.toggle('hidden');

                if (scheduleInfo.classList.contains('hidden')) {
                    this.textContent = 'Schedule';
                } else {
                    this.textContent = 'Close Schedule';
                }
            });
        });

        // Cek status pencarian
        const searchStatus = '{{ session('search_status') }}';
        const searchQuery = '{{ session('search_query') }}';

        if (searchStatus === 'success') {
            Swal.fire({
                title: 'Yoga Ditemukan!',
                text: `Hasil pencarian untuk ${searchQuery}`,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else if (searchStatus === 'not_found') {
            Swal.fire({
                title: 'Yoga Tidak Ditemukan',
                text: `Tidak ada hasil untuk pencarian dengan kriteria: ${searchQuery}`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // For each yoga item, try to create a direct iframe or fallback to a text link
        @foreach ($yogaTotal as $yoga)
            try {
                const mapContainer = document.getElementById('map-{{$yoga->id_yoga}}');
                if (mapContainer) {
                    // Try to create the iframe
                    const iframe = document.createElement('iframe');
                    iframe.src = "{{$yoga->maps}}";
                    iframe.width = "100%";
                    iframe.height = "100%";
                    iframe.style.border = "none";
                    iframe.allowFullscreen = true;
                    iframe.loading = "lazy";
                    iframe.referrerPolicy = "no-referrer-when-downgrade";
                    
                    // Handle errors
                    iframe.onerror = function() {
                        createFallbackLink(mapContainer, "{{$yoga->maps}}");
                    };
                    
                    // Try to detect if the iframe loaded properly
                    iframe.onload = function() {
                        if (!this.contentWindow || !this.contentWindow.location || this.contentWindow.location.href === "about:blank") {
                            createFallbackLink(mapContainer, "{{$yoga->maps}}");
                        }
                    };
                    
                    mapContainer.appendChild(iframe);
                }
            } catch (e) {
                console.error("Error creating map:", e);
                if (mapContainer) {
                    createFallbackLink(mapContainer, "{{$yoga->maps}}");
                }
            }
        @endforeach
        
        function createFallbackLink(container, mapUrl) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center h-full">
                    <p class="text-gray-600 mb-3">Peta tidak dapat dimuat secara langsung</p>
                    <a href="${mapUrl}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Buka di Google Maps
                    </a>
                </div>
            `;
        }
    });
</script>
