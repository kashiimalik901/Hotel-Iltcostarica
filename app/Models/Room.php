<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_type',
        'room_name',
        'short_description',
        'full_description',
        'room_size',
        'capacity_adults',
        'capacity_children',
        'max_occupancy',
        'bed_configuration',
        'bed_type',
        'bed_count',
        'bed_details',
        'tv_type',
        'tv_size',
        'has_wifi',
        'wifi_details',
        'has_safe',
        'safe_type',
        'has_coffeemaker',
        'coffeemaker_type',
        'has_minibar',
        'has_balcony',
        'balcony_details',
        'bathroom_type',
        'shower_type',
        'bathroom_amenities',
        'view_type',
        'view_description',
        'proximity_to_beach',
        'floor_range',
        'special_features',
        'accessibility_features',
        'base_price',
        'currency',
        'tax_inclusive',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'capacity_adults' => 'integer',
        'capacity_children' => 'integer',
        'max_occupancy' => 'integer',
        'bed_count' => 'integer',
        'has_wifi' => 'boolean',
        'has_safe' => 'boolean',
        'has_coffeemaker' => 'boolean',
        'has_minibar' => 'boolean',
        'has_balcony' => 'boolean',
        'tax_inclusive' => 'boolean',
        'sort_order' => 'integer',
        'base_price' => 'decimal:2',
        'bathroom_amenities' => 'array',
        'special_features' => 'array',
        'accessibility_features' => 'array',
    ];

    /**
     * Get the hotel that owns the room.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the images for the room.
     */
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    /**
     * Get the pricing for the room.
     */
    public function pricing()
    {
        return $this->hasMany(RoomPricing::class);
    }

    /**
     * Get the availability for the room.
     */
    public function availability()
    {
        return $this->hasMany(RoomAvailability::class);
    }

    /**
     * Get the bookings for the room.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the availability requests for the room.
     */
    public function availabilityRequests()
    {
        return $this->hasMany(AvailabilityRequest::class);
    }

    /**
     * Get the features for the room.
     */
    public function features()
    {
        return $this->belongsToMany(RoomFeature::class, 'room_feature');
    }

    /**
     * Get the primary image for the room.
     */
    public function primaryImage()
    {
        return $this->hasOne(RoomImage::class)->where('is_primary', true);
    }
}
