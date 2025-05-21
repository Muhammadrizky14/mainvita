<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Booking extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'booking_code',
//         'spa_id',
//         'customer_name',
//         'customer_email',
//         'customer_phone',
//         'booking_date',
//         'booking_time',
//         'notes',
//         'total_amount',
//         'status',
//         'payment_status',
//         'payment_token',
//         'payment_details'
//     ];

//     public function spa()
//     {
//         return $this->belongsTo(Spa::class, 'spa_id', 'id_spa');
//     }

//     public function services() {
//         return $this->hasMany(BookingService::class, 'booking_id');
//     }
// }