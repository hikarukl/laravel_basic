<?php

namespace App\Models;

use App\Constants\CommonConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'admin_id',
        'category_id',
        'content',
        'description',
        'tags',
        'status',
        'thumbnail',
    ];

    public static function booted()
    {
        static::updating(function ($post) {
            Log::info(__FUNCTION__ . ": Updating.");
            $cachePostDetailSlugKey = str_replace("{ID}", $post->slug, CommonConstants::CACHE_POST_DETAIL_NAME);
            $cachePostDetailIdKey = str_replace("{ID}", $post->id, CommonConstants::CACHE_POST_DETAIL_NAME);
            Cache::forget($cachePostDetailSlugKey);
            Cache::forget($cachePostDetailIdKey);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
