<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerPackage extends Model
{
    use HasFactory;

    public function packages(){
        return $this->hasOne(package::class,'id','package_id');
    }
}
