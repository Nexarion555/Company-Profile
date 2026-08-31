<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Portfolio extends Model { protected $table='portfolios'; protected $fillable=['title','client','category','year','location','area','description','image'];  }
