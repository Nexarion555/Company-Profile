<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'position',
        'service_id',
        'rating',
        'testimonial',
        'status',
        'display_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'display_order' => 'integer',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }
}
