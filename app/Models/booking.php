<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;

    public function customer(){
        return $this->hasOne(customer::class,'id','customer_id');
    }
    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
    public function package(){
        return $this->hasOne(customerPackage::class,'id','package_id');
    }
    public function branches(){
        return $this->hasOne(branch::class,'id','branch');
    }
}
