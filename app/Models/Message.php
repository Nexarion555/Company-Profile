<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Message extends Model { protected $table='messages'; protected $fillable=['name','email','subject','msg','is_read']; protected $casts=['is_read'=>'boolean']; }
