<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'destination_id',
        'category_id',
        'setting_type',
        'style',
        'total_rooms',
        'description',
        'short_description',
        'highlight_features',
        'address',
        'city',
        'state_province',
        'country',
        'phone',
        'email',
        'website',
        'latitude',
        'longitude',
        'check_in_time',
        'check_out_time',
        'minimum_check_in_age',
        'pet_policy',
        'cancellation_policy',
        'amenities',
        'awards',
        'sustainability_features',
        'parking_available',
        'parking_type',
        'parking_details',
        'distance_to_airport',
        'nearby_attractions',
        'status',
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'minimum_check_in_age' => 'integer',
        'parking_available' => 'boolean',
        'featured' => 'boolean',
        'sort_order' => 'integer',
        'amenities' => 'array',
        'highlight_features' => 'array',
        'sustainability_features' => 'array',
        'nearby_attractions' => 'array',
    ];

    /**
     * Get the destination that owns the hotel.
     */
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the category that owns the hotel.
     */
    public function category()
    {
        return $this->belongsTo(HotelCategory::class);
    }

    /**
     * Get the images for the hotel.
     */
    public function images()
    {
        return $this->hasMany(HotelImage::class);
    }

    /**
     * Get the rooms for the hotel.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Get the services for the hotel.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the bookings for the hotel.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the availability requests for the hotel.
     */
    public function availabilityRequests()
    {
        return $this->hasMany(AvailabilityRequest::class);
    }

    /**
     * Get the taxes for the hotel.
     */
    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'hotel_taxes');
    }

    /**
     * Get the primary image for the hotel.
     */
    public function primaryImage()
    {
        return $this->hasOne(HotelImage::class)->where('is_primary', true);
    }

    /**
     * Get the check-in time formatted for display.
     */
    public function getCheckInTimeAttribute($value)
    {
        if ($value) {
            // If it's already a string in H:i format, return as is
            if (is_string($value) && preg_match('/^\d{2}:\d{2}$/', $value)) {
                return $value;
            }
            // If it's a Carbon instance, format it
            if ($value instanceof \Carbon\Carbon) {
                return $value->format('H:i');
            }
            // If it's a time string from database, try to parse it
            if (is_string($value)) {
                try {
                    $time = \Carbon\Carbon::parse($value);
                    return $time->format('H:i');
                } catch (\Exception $e) {
                    return $value;
                }
            }
        }
        return null;
    }

    /**
     * Get the check-out time formatted for display.
     */
    public function getCheckOutTimeAttribute($value)
    {
        if ($value) {
            // If it's already a string in H:i format, return as is
            if (is_string($value) && preg_match('/^\d{2}:\d{2}$/', $value)) {
                return $value;
            }
            // If it's a Carbon instance, format it
            if ($value instanceof \Carbon\Carbon) {
                return $value->format('H:i');
            }
            // If it's a time string from database, try to parse it
            if (is_string($value)) {
                try {
                    $time = \Carbon\Carbon::parse($value);
                    return $time->format('H:i');
                } catch (\Exception $e) {
                    return $value;
                }
            }
        }
        return null;
    }
}
