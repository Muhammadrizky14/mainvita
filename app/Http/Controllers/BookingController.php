<?php

// namespace App\Http\Controllers;

// use App\Models\Booking;
// use App\Models\BookingService;
// use App\Models\Spa;
// use App\Models\SpaService;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str;
// use Midtrans\Snap;

// class BookingController extends Controller
// {
//     public function process(Request $request)
//     {
//         // Validate request
//         $request->validate([
//             'spa_id' => 'required|exists:spas,id_spa',
//             'customer_name' => 'required|string|max:255',
//             'customer_email' => 'required|email|max:255',
//             'customer_phone' => 'required|string|max:20',
//             'booking_date' => 'required|date',
//             'booking_time' => 'required',
//             'services' => 'required|array',
//             'services.*.id' => 'required|exists:spa_services,id',
//             'total_amount' => 'required|numeric'
//         ]);

//         try {
//             DB::beginTransaction();

//             // Generate booking code
//             $bookingCode = 'SPA-' . strtoupper(Str::random(8));

//             // Create booking
//             $booking = Booking::create([
//                 'booking_code' => $bookingCode,
//                 'spa_id' => $request->spa_id,
//                 'customer_name' => $request->customer_name,
//                 'customer_email' => $request->customer_email,
//                 'customer_phone' => $request->customer_phone,
//                 'booking_date' => $request->booking_date,
//                 'booking_time' => $request->booking_time,
//                 'notes' => $request->notes,
//                 'total_amount' => $request->total_amount,
//                 'status' => 'pending'
//             ]);

//             // Save booking services
//             foreach ($request->services as $service) {
//                 BookingService::create([
//                     'booking_id' => $booking->id,
//                     'service_id' => $service['id'],
//                     'service_name' => $service['name'],
//                     'price' => $service['price']
//                 ]);
//             }

//             // Get spa details
//             $spa = Spa::find($request->spa_id);

//             // Set up Midtrans payment
// \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
// \Midtrans\Config::$isProduction = config('services.midtrans.is_production');

//             // Prepare Midtrans parameters
//             $params = [
//                 'transaction_details' => [
//                     'order_id' => $bookingCode,
//                     'gross_amount' => (int) $request->total_amount,
//                 ],
//                 'customer_details' => [
//                     'first_name' => $request->customer_name,
//                     'email' => $request->customer_email,
//                     'phone' => $request->customer_phone,
//                 ],
//                 'item_details' => []
//             ];

//             // Add services to item details
//             foreach ($request->services as $service) {
//                 $params['item_details'][] = [
//                     'id' => $service['id'],
//                     'price' => (int) $service['price'],
//                     'quantity' => 1,
//                     'name' => $service['name'] . ' at ' . $spa->nama,
//                 ];
//             }

//             // Create Snap Token
//             $snapToken = Snap::getSnapToken($params);

//             // Update booking with snap token
//             $booking->update([
//                 'payment_token' => $snapToken
//             ]);

//             DB::commit();

//             return response()->json([
//                 'success' => true,
//                 'booking_id' => $booking->id,
//                 'snap_token' => $snapToken
//             ]);
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Error processing booking: ' . $e->getMessage()
//             ], 500);
//         }
//     }

//     public function showPayment($id)
//     {
//         $booking = Booking::with('services')->findOrFail($id);
        
//         return view('booking.payment', compact('booking'));
//     }

//     public function confirmation($id)
//     {
//         $booking = Booking::with('services')->findOrFail($id);
        
//         return view('booking.confirmation', compact('booking'));
//     }

//     public function handlePaymentNotification(Request $request)
//     {
//         $notificationBody = json_decode($request->getContent(), true);
        
//         // Verify signature
//         $orderId = $notificationBody['order_id'];
//         $statusCode = $notificationBody['status_code'];
//         $grossAmount = $notificationBody['gross_amount'];
//         $serverKey = config('midtrans.server_key');
//         $signature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        
//         if ($signature !== $notificationBody['signature_key']) {
//             return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 403);
//         }
        
//         // Find booking by order_id
//         $booking = Booking::where('booking_code', $orderId)->first();
        
//         if (!$booking) {
//             return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
//         }
        
//         // Update booking status based on transaction status
//         $transactionStatus = $notificationBody['transaction_status'];
        
//         if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
//             $booking->status = 'confirmed';
//             $booking->payment_status = 'paid';
//         } elseif ($transactionStatus == 'pending') {
//             $booking->status = 'pending';
//             $booking->payment_status = 'pending';
//         } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
//             $booking->status = 'cancelled';
//             $booking->payment_status = 'failed';
//         }
        
//         $booking->payment_details = json_encode($notificationBody);
//         $booking->save();
        
//         return response()->json(['status' => 'success']);
//     }
// }