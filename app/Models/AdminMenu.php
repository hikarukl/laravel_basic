<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    use HasFactory;

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

    public function subMenus()
    {
        return $this->hasManyThrough(AdminMenuRelation::class, AdminMenu::class, 'id', 'child_id');
    }
}
