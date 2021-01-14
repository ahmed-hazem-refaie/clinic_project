<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;



    protected $fillable = [
        'patient_id', 'clinic_id','comment','status','date','start_time','end_time','cost'
       ];
    

       use SoftDeletes;
       public function patient()
       {
        //    return $this->hasMany('App\ProjectImage','project_id');
        return $this->hasOne(Patient::class);

       }
   
       public function clinic()
       {
           return $this->hasOne(Clinic::class);
       }
}
