<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'name',
        'issuer',
        'certificate_number',
        'issued_year',
        'display_order',
        'description',
        'file_path',
        'file_type',
        'file_name',
    ];

    protected function casts(): array
    {
        return [
            'issued_year' => 'integer',
            'display_order' => 'integer',
        ];
    }
}
