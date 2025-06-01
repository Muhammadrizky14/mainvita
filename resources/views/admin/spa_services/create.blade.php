@extends('layouts.admin')

@section('judul-halaman', 'Add New Service')

@section('content')
<div class="container mx-auto px-2 sm:px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center mb-6 gap-2">
            <h1 class="text-2xl font-bold">Add New Service for {{ $spa->nama }}</h1>
            <a href="{{ route('admin.spas.services.index', $spa->id_spa) }}" class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-center transition">
                Back to Services
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
            <form action="{{ route('admin.spas.services.store', $spa->id_spa) }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <input type="text" name="duration" id="duration" value="{{ old('duration') }}"
                            placeholder="e.g. 1 hr or 30 mins"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="1000"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>

                <div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Active (service will be available for booking)
                        </label>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-2">
                    <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                        Add Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection