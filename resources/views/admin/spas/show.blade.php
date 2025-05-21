@extends('layouts.admin')

@section('judul-halaman', 'Detail Spa')

@section('content')
    <div class="max-w-5xl mx-auto p-4 bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Detail Spa</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.spas.edit', $spa->id_spa) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Edit
                </a>
                <a href="{{ route('admin.spas.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($spa->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $spa->image) }}" alt="{{ $spa->nama }}" 
                             class="w-full h-auto object-cover rounded-lg shadow-md">
                    </div>
                @else
                    <div class="mb-4 bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                        <span class="text-gray-500">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Nama</h3>
                    <p class="mt-1 text-gray-600">{{ $spa->nama }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Harga</h3>
                    <p class="mt-1 text-gray-600">Rp {{ number_format($spa->harga, 0, ',', '.') }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Alamat</h3>
                    <p class="mt-1 text-gray-600">{{ $spa->alamat }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">No. HP</h3>
                    <p class="mt-1 text-gray-600">{{ $spa->noHP }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Waktu Buka</h3>
                    <div class="mt-1 grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($spa->waktuBuka as $hari => $waktu)
                            <div class="flex">
                                <span class="font-medium w-24">{{ $hari }}:</span>
                                <span class="text-gray-600">{{ $waktu }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if($spa->maps)
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Lokasi</h3>
                <div class="w-full h-96 rounded-lg overflow-hidden">
                    {!! $spa->maps !!}
                </div>
            </div>
        @endif
    </div>
@endsection
