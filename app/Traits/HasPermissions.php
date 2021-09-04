<?php

namespace App\Traits;

use App\Models\Permission as PermissionModel;
use Illuminate\Database\Eloquent\Collection;
use App\Models\AdminHasPermission as AdminHasPermissionModel;

trait HasPermissions
{
    /**
     * @var Collection
     */
    protected $permissions;

    /**
     * Get permissions of user
     *
     * @return Collection
     *
     */
    public function getPermissions()
    {
        // Permissions config for user
        $listPermissionIdUser = AdminHasPermissionModel::where('admin_id', $this->id)
            ->get()
            ->pluck('permission_id')->toArray();

        // Permissions config for user's roles
        $listPermissionIdRole = [];
        foreach ($this->getRoles() as $role) {
            $menuPermission = $role->permissions()->get()
                ->pluck('id')->toArray();
            $listPermissionIdRole = array_merge($listPermissionIdRole, $menuPermission);
        }

        $this->permissions = PermissionModel::whereIn('id', array_merge($listPermissionIdUser, $listPermissionIdRole))
            ->get();

        return $this->permissions;
    }

    /**
     * Check permission of user
     *
     * @return bool
     *
     */
    public function hasPermission($permissionName)
    {
        $this->getPermissions();

        foreach (PermissionModel::LIST_PERMISSION_REFERENCE as $key => $val) {
            if (preg_match("/($val)/", $permissionName)) {
                $permissionName = str_replace($val, $key, $permissionName);
            }
        }

        return $this->permissions->where('route', $permissionName)->isNotEmpty();
    }

}