<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'availability_request_id',
        'recipient_email',
        'type',
        'event',
        'template_id',
        'subject',
        'body',
        'status',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Get the booking that owns the notification.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the availability request that owns the notification.
     */
    public function availabilityRequest()
    {
        return $this->belongsTo(AvailabilityRequest::class);
    }

    /**
     * Get the template that owns the notification.
     */
    public function template()
    {
        return $this->belongsTo(NotificationTemplate::class);
    }

    /**
     * Check if the notification has been sent.
     */
    public function isSent(): bool
    {
        return !is_null($this->sent_at);
    }
}
