<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'action',
        'description',
        'model_type',
        'model_id',
    ];

    protected $casts = [
        'model_id' => 'integer',
    ];

    /**
     * Get the user that owns the activity log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking that owns the activity log.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the polymorphic relationship.
     */
    public function subject()
    {
        return $this->morphTo('model');
    }
}
