<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'service',
        'budget',
        'detail',
        'subject',
        'msg',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
