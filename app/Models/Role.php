<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function modules(){
        return $this->belongsToMany(Module::class, 'role_module');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_role');
    }
}
