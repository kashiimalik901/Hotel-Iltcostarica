<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'season_id',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the room that owns the pricing.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the season that owns the pricing.
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
