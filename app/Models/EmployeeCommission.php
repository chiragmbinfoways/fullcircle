<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCommission extends Model
{
    use HasFactory;
    public function branchDetails(){
        return $this->hasOne(branch::class,'id','branch_id');
    }
}
