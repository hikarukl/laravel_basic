<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_ADMIN_NAME = 'Admin';

    protected $fillable = [
        'name',
        'status'
    ];

    /**
     * Get menus of role
     *
     */
    public function menus()
    {
        return $this->belongsToMany(AdminMenu::class, 'role_has_menus');
    }
}
