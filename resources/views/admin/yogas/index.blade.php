@extends('layouts.admin')

@section('judul-halaman', 'Yoga')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Yoga</h1>
            <a href="{{ route('admin.yogas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Yoga Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b text-left">Nama</th>
                        <th class="py-3 px-4 border-b text-left">Harga</th>
                        <th class="py-3 px-4 border-b text-left">Alamat</th>
                        <th class="py-3 px-4 border-b text-left">No. HP</th>
                        <th class="py-3 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($yogas as $yoga)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ is_array($yoga->nama) ? implode(', ', $yoga->nama) : $yoga->nama }}</td>
                            <td class="py-3 px-4 border-b">
                                Rp {{ number_format(is_array($yoga->harga) ? $yoga->harga[0] : $yoga->harga, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ is_array($yoga->alamat) ? implode(', ', $yoga->alamat) : $yoga->alamat }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ is_array($yoga->noHP) ? implode(', ', $yoga->noHP) : $yoga->noHP }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.yogas.show', $yoga->id_yoga) }}" class="text-blue-500 hover:text-blue-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.yogas.edit', $yoga->id_yoga) }}" class="text-yellow-500 hover:text-yellow-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.yogas.destroy', $yoga->id_yoga) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus yoga ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-4 border-b text-center text-gray-500">Tidak ada data yoga</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
