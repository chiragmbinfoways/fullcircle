<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
    public function package(){
        return $this->hasOne(CustomerPackage::class,'id','package_id');
    }
    public function branches(){
        return $this->hasOne(Branch::class,'id','branch');
    }
}
