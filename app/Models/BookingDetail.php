<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class BookingDetail extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'booking_id',
//         'service_id',
//         'service_name',
//         'price',
//     ];

//     /**
//      * Get the booking that owns the booking detail.
//      */
//     public function booking()
//     {
//         return $this->belongsTo(Booking::class);
//     }

//     /**
//      * Get the service that owns the booking detail.
//      */
//     public function service()
//     {
//         return $this->belongsTo(SpaService::class, 'service_id');
//     }
// }