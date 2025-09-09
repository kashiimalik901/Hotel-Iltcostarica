<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'service_id',
        'tour_id',
        'service_type',
        'name',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'currency',
        'service_date',
        'added_at',
        'added_by',
        'status',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'service_date' => 'date',
        'added_at' => 'datetime',
    ];

    /**
     * Get the booking that owns the service.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the service that owns the booking service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the tour that owns the booking service.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
