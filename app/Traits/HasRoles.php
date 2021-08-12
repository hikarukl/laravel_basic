<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

trait HasRoles
{
    /**
     * @var Collection
     */
    protected $roles;

    /**
     * Get roles of user
     *
     * @return Collection
     *
     */
    public function getRoles()
    {
        $this->roles = $this->belongsToMany(Role::class, 'admin_has_roles')->get();

        return $this->roles;
    }

    /**
     * Check role of user
     *
     * @return bool
     *
     */
    public function hasRole($roleName)
    {
        $this->getRoles();

        return $this->roles->where('name', $roleName)->isNotEmpty();
    }

}