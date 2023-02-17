<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeService extends Model
{
    use HasFactory;

    public function servicesDetail(){
        return $this->hasOne(Services::class,'id','service_id');
    }
    public function employeeDetails(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}
