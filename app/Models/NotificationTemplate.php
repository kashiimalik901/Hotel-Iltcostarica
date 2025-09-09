<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event',
        'subject',
        'body',
        'variables',
        'is_active',
    ];

    protected $casts = [
        'variables' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the notifications for the template.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'template_id');
    }

    /**
     * Check if the template is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }
}
