<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
class Role extends Model
{
    use HasFactory;

    public function permission(){
        $this->belongsToMany(Permission::class,'roles_permission');
    }
}
