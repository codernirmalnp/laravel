<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;

class Permission extends Model
{
    use HasFactory;
    public function roles(){

        return $this->belongsToMany(Roles::class,'roles_permissions');

    }
}
