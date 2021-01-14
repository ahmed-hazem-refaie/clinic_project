<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'mobile','age','gender','patient_no',
       ];
    

       use SoftDeletes;
       public function orders()
       {
           return $this->hasMany(Order::class);
       }
   
  
       
}
