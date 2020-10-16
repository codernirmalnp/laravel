<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
trait HasRolesAndPermissions
{
    /**
     * @return mixed
     */
    //relationship between user and roles
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    /**
     * @return mixed
     */
    //relationship between user and permission
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    /**
     * @param mixed ...$roles
     * @return bool
     */
    //Check if the current user has Any role
    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    //The above method will check if the user’s permissions contain the given permission
    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission);
    }

    /**
     * @param $permission
     * @return bool
     */
    //check if the users has permission through its role
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
 * @param array $permissions
 * @return mixed
 */

//Attach some Permission to current User
    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug',$permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

}