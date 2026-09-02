<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'client',
        'service_id',
        'category',
        'year',
        'location',
        'area',
        'description',
        'image',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'year' => 'integer',
        'display_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function categoryLabel(): string
    {
        return $this->service?->title ?: ($this->category ?: 'Tanpa Layanan');
    }
}
