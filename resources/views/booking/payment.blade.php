<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-6 text-center">Complete Your Payment</h2>
                    
                    <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Booking Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Booking Code</p>
                                <p class="font-medium">{{ $booking->booking_code }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                <p class="font-medium">
                                    @if($booking->status == 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Confirmed</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Cancelled</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Customer Name</p>
                                <p class="font-medium">{{ $booking->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Booking Date & Time</p>
                                <p class="font-medium">{{ date('d M Y', strtotime($booking->booking_date)) }} at {{ date('H:i', strtotime($booking->booking_time)) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-2">Services</h3>
                        <div class="border rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($booking->services as $service)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $service->service_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">Total</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button id="pay-button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                            Pay Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // Open Midtrans Snap
            window.snap.pay('{{ $booking->payment_token }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location.href = '/booking/confirmation/{{ $booking->id }}';
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert('Payment pending. Please complete your payment.');
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert('Payment failed. Please try again.');
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('You closed the payment window without completing the payment.');
                }
            });
        };
    </script>
</x-app-layout>