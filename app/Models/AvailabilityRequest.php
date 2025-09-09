<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'room_id',
        'hotel_id',
        'check_in_date',
        'check_out_date',
        'guests_adults',
        'guests_children',
        'customer_email',
        'customer_phone',
        'special_requests',
        'status',
        'responded_at',
        'responded_by',
        'expires_at',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'guests_adults' => 'integer',
        'guests_children' => 'integer',
        'responded_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the customer that owns the availability request.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the room that owns the availability request.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the hotel that owns the availability request.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the user who responded to the availability request.
     */
    public function respondedBy()
    {
        return $this->belongsTo(User::class, 'responded_by');
    }

    /**
     * Get the notifications for the availability request.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
