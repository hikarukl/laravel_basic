<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstant;
use App\Services\Article;
use App\Services\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
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
        if (Cache::has(CommonConstant::CACHE_HOME_NAME)) {
            $response = Cache::get(CommonConstant::CACHE_HOME_NAME);
        } else {
            // Request get call categories
            $allCategories = $this->categoryService->getAllCategories();

            // Request get filter categories for main menu display
            $filteredCategory = array_filter($allCategories, function ($item) {
                return in_array($item['id'], Category::CATEGORY_LIST_FILTER_MAP);
            });

            if (empty($allCategories)) {
                return view('errors.500');
            }

            // Request get articles base on cate gory slug
            $categoryArticleList = [];
            foreach ($allCategories as $cateId => $categoryInfo) {
                $articles = $this->articleService->getArticleBaseOnCategorySlug($categoryInfo['slug']);

                if (count($articles) < CommonConstant::MIN_ARTICLES_NEED_TO_DISPLAY) {
                    continue;
                }

                // Calculate articles to set view
                $viewComponent = "component_common.block_style_default";
                if (count($articles) > 12) {
                    $articles = array_slice($articles, 0, 12);
                    $viewComponent = "component_common.block_three_columns_style_two";
                }

                if (count($articles) >= 7) {
                    $articles = array_slice($articles, 0, 7);
                    $viewComponent = "component_common.block_three_columns_style_one";
                }

                $categoryArticleList[$cateId] = [
                    'category_id'   => $categoryInfo['id'],
                    'category_name' => $categoryInfo['name'],
                    'category_slug' => $categoryInfo['slug'],
                    'view_name'     => $viewComponent,
                    'article_list'  => $articles
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
                'category_article_list'    => $categoryArticleList
            ];
            Cache::put(
                CommonConstant::CACHE_HOME_NAME,
                $response,
                now()->addMinutes(CommonConstant::CACHE_HOME_EXPIRE_IN_MINUTES)
            );
        }

        return view('pages.home.index', $response);
    }
}
