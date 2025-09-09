<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate',
        'type',
        'applies_to',
        'country',
        'is_active',
    ];

    protected $casts = [
        'rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the hotels that have this tax.
     */
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_taxes');
    }

    /**
     * Get the formatted rate as percentage.
     */
    public function getFormattedRateAttribute(): string
    {
        return number_format($this->rate * 100, 2) . '%';
    }
}
