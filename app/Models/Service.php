<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'name',
        'description',
        'category',
        'subcategory',
        'price',
        'price_type',
        'currency',
        'is_available',
        'can_add_after_booking',
        'requires_quote',
        'advance_booking_required',
        'advance_notice_hours',
        'departure_location',
        'duration',
        'includes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'can_add_after_booking' => 'boolean',
        'requires_quote' => 'boolean',
        'advance_booking_required' => 'boolean',
        'advance_notice_hours' => 'integer',
        'includes' => 'array',
    ];

    /**
     * Get the hotel that owns the service.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the booking services for the service.
     */
    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }
}
