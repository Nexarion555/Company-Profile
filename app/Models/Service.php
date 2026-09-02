<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'image_path',
        'fallback_image_url',
        'features',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'display_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function imageUrl(): string
    {
        if ($this->image_path) {
            return Storage::disk('public')->url($this->image_path);
        }

        return $this->fallback_image_url ?: 'https://picsum.photos/seed/service-construction/800/600';
    }
}
