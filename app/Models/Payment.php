<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_link_id',
        'payment_method',
        'transaction_id',
        'gateway_payment_id',
        'amount',
        'currency',
        'payment_type',
        'status',
        'gateway_response',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * Get the booking that owns the payment.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the payment link that owns the payment.
     */
    public function paymentLink()
    {
        return $this->belongsTo(PaymentLink::class);
    }

    /**
     * Get the refunds for the payment.
     */
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    /**
     * Check if the payment is successful.
     */
    public function isSuccessful(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if the payment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
