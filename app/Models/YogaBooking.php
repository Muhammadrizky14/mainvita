<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YogaBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'yoga_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'booking_date',
        'booking_time',
        'notes',
        'total_amount',
        'status',
        'payment_status',
        'payment_token',
        'payment_details'
    ];

    /**
     * Get the yoga associated with the booking.
     */
    public function yoga()
    {
        return $this->belongsTo(Yoga::class, 'yoga_id');
    }

    /**
     * Get the services for this booking.
     */
    public function services()
    {
        return $this->hasMany(YogaBookingService::class, 'booking_id');
    }
}