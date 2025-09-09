<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'date',
        'available_rooms',
        'total_rooms',
        'price_override',
    ];

    protected $casts = [
        'date' => 'date',
        'available_rooms' => 'integer',
        'total_rooms' => 'integer',
        'price_override' => 'decimal:2',
    ];

    /**
     * Get the room that owns the availability.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
