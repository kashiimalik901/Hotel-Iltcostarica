<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'price_modifier',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price_modifier' => 'decimal:2',
    ];

    /**
     * Get the room pricing for the season.
     */
    public function roomPricing()
    {
        return $this->hasMany(RoomPricing::class);
    }
}
