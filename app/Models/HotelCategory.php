<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the hotels for the category.
     */
    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'category_id');
    }
}
