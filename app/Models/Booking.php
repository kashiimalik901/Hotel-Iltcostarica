<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference',
        'customer_id',
        'hotel_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'nights',
        'guests_adults',
        'guests_children',
        'room_rate',
        'room_total',
        'extras_total',
        'subtotal',
        'tax_amount',
        'total_price',
        'currency',
        'status',
        'payment_status',
        'special_requests',
        'room_preferences',
        'interested_in_transportation',
        'transportation_notes',
        'confirmed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'nights' => 'integer',
        'guests_adults' => 'integer',
        'guests_children' => 'integer',
        'room_rate' => 'decimal:2',
        'room_total' => 'decimal:2',
        'extras_total' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'interested_in_transportation' => 'boolean',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Get the customer that owns the booking.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the hotel that owns the booking.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the room that owns the booking.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the services for the booking.
     */
    public function services()
    {
        return $this->hasMany(BookingService::class);
    }

    /**
     * Get the payment links for the booking.
     */
    public function paymentLinks()
    {
        return $this->hasMany(PaymentLink::class);
    }

    /**
     * Get the payments for the booking.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the refunds for the booking.
     */
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    /**
     * Get the notifications for the booking.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the activity logs for the booking.
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Calculate the total price including extras and taxes.
     */
    public function calculateTotal(): float
    {
        return $this->room_total + $this->extras_total + $this->tax_amount;
    }

    /**
     * Check if the booking is confirmed.
     */
    public function isConfirmed(): bool
    {
        return !is_null($this->confirmed_at);
    }

    /**
     * Check if the booking is cancelled.
     */
    public function isCancelled(): bool
    {
        return !is_null($this->cancelled_at);
    }
}
