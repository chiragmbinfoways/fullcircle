<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;
    public function services(){
        return $this->hasOne(services::class,'id','service');
    }
}
