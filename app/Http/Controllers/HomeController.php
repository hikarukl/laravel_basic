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
            $categoryList = [];

            foreach ($allCategories as $cateId => $categoryInfo) {
                $categoryList[$cateId] = $categoryInfo['slug'];
            }

            $postBySlugs = $this->articleService->getArticleBaseOnCategorySlugAsync($categoryList);

            foreach ($postBySlugs as $categoryId => $listPerCate) {
                if (count($listPerCate) < CommonConstant::MIN_ARTICLES_NEED_TO_DISPLAY) {
                    continue;
                }

                // Calculate articles to set view
                $viewComponent = "component_common.block_style_default";
                if (count($listPerCate) > 12) {
                    $listPerCate = array_slice($listPerCate, 0, 12);
                    $viewComponent = "component_common.block_three_columns_style_two";
                }

                if (count($listPerCate) >= 7) {
                    $listPerCate = array_slice($listPerCate, 0, 7);
                    $viewComponent = "component_common.block_three_columns_style_one";
                }

                $categoryArticleList[$categoryId] = [
                    'category_id'   => $categoryId,
                    'category_name' => $listPerCate[0]['category']['name'],
                    'category_slug' => $categoryList[$categoryId],
                    'view_name'     => $viewComponent,
                    'article_list'  => $listPerCate
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
