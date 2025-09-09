<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'category',
    ];

    /**
     * Get the rooms that have this feature.
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_feature');
    }
}
