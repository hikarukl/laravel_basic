<?php


namespace App\Services;

use App\Constants\CommonConstants;
use App\Models\Post as PostModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Post
{
    /**
     * Get post list with pagination
     *
     * @param array $options
     *
     * @return LengthAwarePaginator
     *
     */
    public function getAllListPagination($options)
    {
        if (isset($options['category_slug'])) {
            return PostModel::with(['category'])
                ->join('categories', 'categories.id', '=', 'posts.category_id')
                ->where('categories.slug', $options['category_slug'])
                ->orderBy('posts.id', 'desc')
                ->paginate($options['limit']);
        }
        return PostModel::with(['category'])->orderBy('posts.id', 'desc')->paginate($options['limit']);
    }

    /**
     * Get post detail by id
     *
     * @param int $postId
     *
     * @return Collection
     *
     */
    public function detailById($postId)
    {
        // Get post detail
        $postCacheKey = str_replace("{ID}", $postId, CommonConstants::CACHE_POST_DETAIL_NAME);
        if (Cache::has($postCacheKey)) {
            $postDetail = Cache::get($postCacheKey);
        } else {
            $postDetail = \App\Models\Post::find($postId);
            Cache::put($postCacheKey, $postDetail, CommonConstants::CACHE_DEFAULT_EXPIRED_MINUTES);
        }

        return $postDetail;
    }

    /**
     * Get post detail by slug
     *
     * @param string $postSlug
     *
     * @return Collection
     *
     */
    public function detailBySlug($postSlug)
    {
        // Get post detail
        $postCacheKey = str_replace("{ID}", $postSlug, CommonConstants::CACHE_POST_DETAIL_NAME);
        if (Cache::has($postCacheKey)) {
            $postDetail = Cache::get($postCacheKey);
        } else {
            $postDetail = \App\Models\Post::where('slug', $postSlug)->first();
            Cache::put($postCacheKey, $postDetail, CommonConstants::CACHE_DEFAULT_EXPIRED_MINUTES);
        }

        return $postDetail;
    }

    /**
     * Get recent posts
     *
     * @return Collection
     *
     */
    public function getRecentPosts()
    {
        if (Cache::has(CommonConstants::CACHE_POST_RECENT_NAME)) {
            return Cache::get(Cache::has(CommonConstants::CACHE_POST_RECENT_NAME));
        }

        return PostModel::with(['category'])
            ->orderBy('posts.id', 'desc')
            ->limit(CommonConstants::DEFAULT_LIMIT_SEARCH)
            ->get();
    }
}