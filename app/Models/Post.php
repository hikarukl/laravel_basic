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
        // Update then update cache involves with post
        static::updated(function ($post) {
            Log::info(__FUNCTION__ . ": Updating.");

            $cachePostDetailSlugKey = str_replace("{ID}", $post->slug, CommonConstants::CACHE_POST_DETAIL_NAME);
            $cachePostDetailIdKey = str_replace("{ID}", $post->id, CommonConstants::CACHE_POST_DETAIL_NAME);
            Cache::put($cachePostDetailSlugKey, $post, CommonConstants::CACHE_DEFAULT_EXPIRED_MINUTES);
            Cache::put($cachePostDetailIdKey, $post, CommonConstants::CACHE_DEFAULT_EXPIRED_MINUTES);
        });
        // Create then update cache involves with post list
        static::created(function ($post) {
            $postRecentList = Cache::get(CommonConstants::CACHE_POST_RECENT_NAME);
            if ($postRecentList) {
                $postRecentList->prepend($post);
                Cache::put(CommonConstants::CACHE_POST_RECENT_NAME, $postRecentList, CommonConstants::CACHE_DEFAULT_EXPIRED_MINUTES);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
