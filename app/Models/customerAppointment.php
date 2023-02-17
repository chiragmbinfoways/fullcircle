<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAppointment extends Model
{
    use HasFactory;
    public function employee(){
        return $this->hasOne(Employee::class,'id','Trainer');
    }
}
