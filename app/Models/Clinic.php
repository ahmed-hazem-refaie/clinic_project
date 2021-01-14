<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description','location_lng','location_lat','image','status'
       ];


       use SoftDeletes;

       public function orders()
       {
        //    return $this->belongsToMany(Order::class,'orders','id','clinic_id','clinics');
           return $this->hasMany(Order::class);
       }
   
       public function patients()
       {
           return $this->belongsToMany(Patient::class,'orders');
       }
    
    }
