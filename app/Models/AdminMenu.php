<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    use HasFactory;

    const MENU_IS_ROOT_NUM = 1;
    const MENU_IS_CHILD_NUM = 0;

    protected $fillable = [
        'name',
        'slug',
        'route'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeMenuList($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
            ->where('is_root', self::MENU_IS_ROOT_NUM)
            ->orderBy('priority', 'asc');
    }

    public function subMenus()
    {
        return $this->hasManyThrough(AdminMenu::class, AdminMenuRelation::class, 'parent_id', 'id', 'id', 'child_id');
    }
}
