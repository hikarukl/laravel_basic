<?php

namespace App\Models;

use App\Constants\CommonConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function frontendMenu()
    {
        return $this->belongsTo(FrontendMenu::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', CommonConstants::STATUS_ACTIVE_NUMBER);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
