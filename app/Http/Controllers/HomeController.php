<?php

namespace App\Http\Controllers;

use App\Services\Article;
use App\Services\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    const CACHE_HOME_NAME = "GET_HOME_INFORMATION";
    const CACHE_HOME_EXPIRE_IN_MINUTES = 10;

    protected $categoryService;
    protected $articleService;

    public function __construct(Category $categoryService, Article $articleService)
    {
        $this->categoryService = $categoryService;
        $this->articleService = $articleService;
    }

    /**
     * Home page
     *
     *
     */
    public function index()
    {
        // Check cache
        if (Cache::has(self::CACHE_HOME_NAME)) {
            $response = Cache::get(self::CACHE_HOME_NAME);
        } else {
            // Request get call categories
            $allCategories = $this->categoryService->getAllCategories(false);

            // Request get filter categories for main menu display
            $filteredCategory = array_filter($allCategories, function ($item) {
                return in_array($item[0]['id'], Category::CATEGORY_LIST_FILTER_MAP);
            });

            if (empty($allCategories)) {
                return view('errors.500');
            }

            // Request get articles base on cate gory slug
            $categoryArticleList = [];
            foreach ($allCategories as $cateId => $categoryInfo) {
                $categoryArticleList[$cateId] = [
                    'category_id'   => $categoryInfo[0]['id'],
                    'category_name' => $categoryInfo[0]['name'],
                    'category_slug' => $categoryInfo[0]['slug'],
                    'article_list'  => $this->articleService->getArticleBaseOnCategorySlug($categoryInfo[0]['slug'])
                ];
            }

            // Request get newest 100 articles
            $newestArticles = $this->articleService->getArticles();

            // Get 5 top posts : Get from social
            $topPostList = array_slice($newestArticles, 0, 5);

            // Get 4 focus posts
            $focusPostList = array_slice($newestArticles, 5, 5);

            // Get 9 newest posts
            $newPostList = array_slice($newestArticles, 10, 9);

            // Get another posts
            $anotherPostList = array_slice($newestArticles, 19, 15);

            $anotherPostListWeb = array_chunk($anotherPostList, 5);

            $response = [
                'category_list'            => $allCategories,
                'menu_list'                => $filteredCategory,
                'top_post_list'            => $topPostList,
                'focus_post_list'          => $focusPostList,
                'new_post_list'            => $newPostList,
                'another_post_list'        => $anotherPostListWeb,
                'another_post_list_mobile' => $anotherPostList,
            ];
            Cache::add(self::CACHE_HOME_NAME, $response, now()->addMinutes(self::CACHE_HOME_EXPIRE_IN_MINUTES));
        }

        return view('pages.home.index', $response);
    }
}
