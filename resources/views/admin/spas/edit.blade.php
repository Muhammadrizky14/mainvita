@extends('layouts.admin')

@section('judul-halaman', 'Edit Spa')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Spa</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.spas.update', $spa->id_spa) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block mb-2">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ $spa->nama }}"
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="harga" class="block mb-2">Harga</label>
                <input type="number" name="harga" id="harga" value="{{ $spa->harga }}"
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="alamat" class="block mb-2">Alamat</label>
                <textarea name="alamat" id="alamat" class="w-full px-3 py-2 border rounded">{{ $spa->alamat }}</textarea>
            </div>

            <div class="mb-4">
                <label for="noHP" class="block mb-2">No. HP</label>
                <input type="text" name="noHP" id="noHP" value="{{ $spa->noHP }}"
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Buka</label>
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                    <div class="flex items-center space-x-2 mt-2">
                        <label for="waktuBuka_{{ strtolower($hari) }}" class="w-20">{{ $hari }}</label>
                        <input type="text" name="waktuBuka[{{ $hari }}]"
                            id="waktuBuka_{{ strtolower($hari) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="contoh: 09:00-20:00"
                            value="{{ $spa->waktuBuka[$hari] ?? '' }}"
                            required>
                    </div>
                @endforeach
                <small class="text-gray-500 mt-2 block">Format: HH:MM-HH:MM, contoh: 09:00-20:00</small>
            </div>

            <div class="mb-4">
                <label for="maps" class="block mb-2">Link Google Maps</label>
                <input type="text" name="maps" id="maps" value="{{ $spa->maps }}"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Masukkan URL Google Maps atau alamat lokasi">
                <small class="text-gray-500 mt-1 block">
                    Anda dapat memasukkan URL Google Maps (https://maps.google.com/...), URL embed Google Maps, atau cukup masukkan alamat lokasi.
                </small>
                <div class="mt-2">
                    <details class="bg-gray-50 p-2 rounded-md">
                        <summary class="text-sm text-blue-600 cursor-pointer">Cara mendapatkan link Google Maps</summary>
                        <ol class="mt-2 text-sm text-gray-600 list-decimal pl-5">
                            <li>Buka Google Maps (maps.google.com)</li>
                            <li>Cari lokasi spa Anda</li>
                            <li>Klik tombol "Bagikan" atau "Share"</li>
                            <li>Pilih tab "Embed a map"</li>
                            <li>Salin kode HTML yang muncul</li>
                            <li>Dari kode tersebut, salin URL yang ada di dalam tanda kutip setelah "src="</li>
                        </ol>
                    </details>
                </div>
                
                @if($spa->maps)
                <div class="mt-4 border rounded p-2">
                    <p class="text-sm font-medium mb-2">Preview Maps:</p>
                    <iframe src="{{ $spa->maps }}" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="image" class="block mb-2">Gambar</label>
                @if($spa->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $spa->image) }}" alt="Spa Image" class="w-32 h-32 object-cover">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="w-full px-3 py-2 border rounded">
                <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar</small>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('admin.spas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
