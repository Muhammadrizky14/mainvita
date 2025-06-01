@extends('layouts.admin')

@section('judul-halaman', 'Manage Spa Services')

@section('content')
<div class="container mx-auto px-2 sm:px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center mb-6 gap-2">
        <div>
            <h1 class="text-2xl font-bold">Services for {{ $spa->nama }}</h1>
            <p class="text-gray-600">Manage the services offered by this spa location</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('admin.spas.services.create', $spa->id_spa) }}" 
               class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-center transition">
                Add New Service
            </a>
            <a href="{{ route('admin.spas.index') }}" 
               class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-center transition">
                Back to Spas
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if(count($services) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Duration</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($services as $service)
                            <tr>
                                <td class="px-4 py-4 whitespace-normal break-words">
                                    <div class="font-medium text-gray-900">{{ $service->name }}</div>
                                    <div class="text-gray-500">{{ Str::limit($service->description, 50) }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-gray-500">
                                    {{ $service->duration }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-gray-500">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <a href="{{ route('admin.spas.services.edit', [$spa->id_spa, $service->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.spas.services.destroy', [$spa->id_spa, $service->id]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-4 text-center text-gray-500">
                No services found for this spa. <a href="{{ route('admin.spas.services.create', $spa->id_spa) }}" class="text-blue-500 hover:underline">Add a new service</a>.
            </div>
        @endif
    </div>
</div>
@endsection