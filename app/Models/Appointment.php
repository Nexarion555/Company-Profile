<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'date',
        'time',
        'notes',
        'admin_note',
        'status',
        'notification_sent_at',
        'notified_status',
    ];

    protected $casts = [
        'date' => 'date',
        'notification_sent_at' => 'datetime',
    ];
}
