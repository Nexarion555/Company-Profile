<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Appointment extends Model { protected $table='appointments'; protected $fillable=['name','phone','email','type','date','time','notes','status']; protected $casts=['date'=>'date']; }
