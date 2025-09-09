<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'departure_location',
        'destination',
        'duration',
        'price',
        'price_type',
        'includes',
        'requirements',
        'availability_days',
        'max_participants',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'max_participants' => 'integer',
        'is_active' => 'boolean',
        'includes' => 'array',
        'requirements' => 'array',
    ];

    /**
     * Get the booking services for the tour.
     */
    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }
}
