<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'tax_id',
    ];

    /**
     * Get the hotel that owns the hotel tax.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the tax that owns the hotel tax.
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}
