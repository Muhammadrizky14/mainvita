<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\Booking;
// use App\Models\Spa;
// use Illuminate\Http\Request;
// use Carbon\Carbon;

// class BookingsController extends Controller
// {
//     /**
//      * Display a listing of the bookings.
//      */
//     public function index(Request $request)
//     {
//         $query = Booking::with(['spa', 'details']);

//         // Filter by status
//         if ($request->has('status') && $request->status != 'all') {
//             $query->where('status', $request->status);
//         }

//         // Filter by spa
//         if ($request->has('spa_id') && $request->spa_id != 'all') {
//             $query->where('spa_id', $request->spa_id);
//         }

//         // Filter by date range
//         if ($request->has('date_from') && $request->date_from) {
//             $query->where('booking_date', '>=', $request->date_from);
//         }

//         if ($request->has('date_to') && $request->date_to) {
//             $query->where('booking_date', '<=', $request->date_to);
//         }

//         // Search by booking code or customer name
//         if ($request->has('search') && $request->search) {
//             $search = $request->search;
//             $query->where(function($q) use ($search) {
//                 $q->where('booking_code', 'like', "%{$search}%")
//                   ->orWhere('customer_name', 'like', "%{$search}%")
//                   ->orWhere('customer_email', 'like', "%{$search}%")
//                   ->orWhere('customer_phone', 'like', "%{$search}%");
//             });
//         }

//         // Order by latest bookings first
//         $query->orderBy('created_at', 'desc');

//         // Get all spas for filter dropdown
//         $spas = Spa::all();
        
//         // Get bookings with pagination
//         $bookings = $query->paginate(10)->withQueryString();
        
//         // Get counts for dashboard stats
//         $stats = [
//             'total' => Booking::count(),
//             'pending' => Booking::where('status', 'pending')->count(),
//             'success' => Booking::where('status', 'success')->count(),
//             'failed' => Booking::where('status', 'failed')->count(),
//             'today' => Booking::whereDate('created_at', Carbon::today())->count(),
//             'revenue' => Booking::where('status', 'success')->sum('total_amount'),
//         ];

//         return view('admin.bookings.index', compact('bookings', 'spas', 'stats'));
//     }

//     /**
//      * Display the specified booking.
//      */
//     public function show($id)
//     {
//         $booking = Booking::with(['spa', 'details'])->findOrFail($id);
        
//         return view('admin.bookings.show', compact('booking'));
//     }

//     /**
//      * Update the booking status.
//      */
//     public function updateStatus(Request $request, $id)
//     {
//         $request->validate([
//             'status' => 'required|in:pending,success,failed,cancelled,completed',
//         ]);

//         $booking = Booking::findOrFail($id);
//         $booking->status = $request->status;
//         $booking->save();

//         return redirect()->route('admin.bookings.show', $id)
//             ->with('success', 'Booking status updated successfully');
//     }

//     /**
//      * Export bookings to CSV.
//      */
//     public function export(Request $request)
//     {
//         $query = Booking::with(['spa', 'details']);

//         // Apply the same filters as in the index method
//         if ($request->has('status') && $request->status != 'all') {
//             $query->where('status', $request->status);
//         }

//         if ($request->has('spa_id') && $request->spa_id != 'all') {
//             $query->where('spa_id', $request->spa_id);
//         }

//         if ($request->has('date_from') && $request->date_from) {
//             $query->where('booking_date', '>=', $request->date_from);
//         }

//         if ($request->has('date_to') && $request->date_to) {
//             $query->where('booking_date', '<=', $request->date_to);
//         }

//         if ($request->has('search') && $request->search) {
//             $search = $request->search;
//             $query->where(function($q) use ($search) {
//                 $q->where('booking_code', 'like', "%{$search}%")
//                   ->orWhere('customer_name', 'like', "%{$search}%")
//                   ->orWhere('customer_email', 'like', "%{$search}%")
//                   ->orWhere('customer_phone', 'like', "%{$search}%");
//             });
//         }

//         $bookings = $query->orderBy('created_at', 'desc')->get();

//         $filename = 'bookings_' . date('Y-m-d_His') . '.csv';
//         $headers = [
//             'Content-Type' => 'text/csv',
//             'Content-Disposition' => "attachment; filename=\"$filename\"",
//         ];

//         $callback = function() use ($bookings) {
//             $file = fopen('php://output', 'w');
            
//             // Add CSV header
//             fputcsv($file, [
//                 'Booking Code',
//                 'Customer Name',
//                 'Customer Email',
//                 'Customer Phone',
//                 'Spa',
//                 'Booking Date',
//                 'Booking Time',
//                 'Services',
//                 'Total Amount',
//                 'Status',
//                 'Created At'
//             ]);

//             // Add data rows
//             foreach ($bookings as $booking) {
//                 $services = $booking->details->pluck('service_name')->implode(', ');
                
//                 fputcsv($file, [
//                     $booking->booking_code,
//                     $booking->customer_name,
//                     $booking->customer_email,
//                     $booking->customer_phone,
//                     $booking->spa->nama,
//                     $booking->booking_date,
//                     $booking->booking_time,
//                     $services,
//                     $booking->total_amount,
//                     $booking->status,
//                     $booking->created_at
//                 ]);
//             }

//             fclose($file);
//         };

//         return response()->stream($callback, 200, $headers);
//     }
// }