@extends('layouts.admin')

@section('judul-halaman', 'Booking Details')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Booking Details</h1>
            <p class="text-gray-600">View and manage booking information</p>
        </div>
        <div>
            <a href="{{ route('admin.bookings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to Bookings
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Booking #{{ $booking->booking_code }}
                </h3>
                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                    {{ $booking->status == 'success' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $booking->status == 'failed' ? 'bg-red-100 text-red-800' : '' }}
                    {{ $booking->status == 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}
                    {{ $booking->status == 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                ">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Created on {{ $booking->created_at->format('d M Y H:i') }}
            </p>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Customer Information -->
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Name</p>
                            <p class="font-medium">{{ $booking->customer_name }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $booking->customer_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Phone</p>
                            <p class="font-medium">{{ $booking->customer_phone }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Booking Details -->
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Booking Details</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Spa Location</p>
                            <p class="font-medium">{{ $booking->spa->nama }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Time</p>
                            <p class="font-medium">{{ $booking->booking_time }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Services -->
            <div class="mt-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Services Booked</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-left py-2 text-sm font-medium text-gray-500">Service</th>
                                <th class="text-right py-2 text-sm font-medium text-gray-500">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking->details as $detail)
                            <tr>
                                <td class="py-2 text-sm">{{ $detail->service_name }}</td>
                                <td class="py-2 text-right text-sm">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr class="border-t">
                                <td class="py-2 font-bold">Total</td>
                                <td class="py-2 text-right font-bold">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Payment Information -->
            <div class="mt-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Payment Status</p>
                        <p class="font-medium">{{ $booking->payment_status ? ucfirst($booking->payment_status) : 'Not available' }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Payment Method</p>
                        <p class="font-medium">{{ $booking->payment_method ?: 'Not available' }}</p>
                    </div>
                    @if($booking->payment_details)
                    <div>
                        <p class="text-sm text-gray-500">Payment Details</p>
                        <pre class="mt-1 text-sm text-gray-600 bg-gray-100 p-2 rounded overflow-auto">{{ $booking->payment_details }}</pre>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Update Status -->
            <div class="mt-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Update Booking Status</h4>
                <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST" class="bg-gray-50 p-4 rounded-lg">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center space-x-4">
                        <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="success" {{ $booking->status == 'success' ? 'selected' : '' }}>Success</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="failed" {{ $booking->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
