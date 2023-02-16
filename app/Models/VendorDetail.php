<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    use HasFactory;
    protected $table = "vendorDetails";
    protected $guarded = [];

    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
