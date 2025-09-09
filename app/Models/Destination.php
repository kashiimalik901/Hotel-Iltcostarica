<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'country',
        'region',
        'is_featured',
        'image_url',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Get the hotels for the destination.
     */
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
