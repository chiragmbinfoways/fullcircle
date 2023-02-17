<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function services(){
        return $this->hasOne(Services::class,'id','service');
    }
    public function branches(){
        return $this->hasOne(Branch::class,'id','branch');
    }
}
