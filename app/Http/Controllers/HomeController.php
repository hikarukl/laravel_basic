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

            // Filter categories for content display
            $filteredContentCategory = array_filter($allCategories, function ($item) {
                return in_array($item['id'], Category::CATEGORY_LIST_CONTENT_FILTER_MAP);
            });

            if (empty($allCategories)) {
                return view('errors.500');
            }

            // Request get articles base on cate gory slug
            $categoryArticleList = [];
            $categoryList = [];

            foreach ($filteredContentCategory as $cateId => $categoryInfo) {
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

            $newestArticles = array_filter($newestArticles, function ($item) {
               return  in_array($item['category']['id'], array_keys(CommonConstant::CATEGORY_LIST_MAP));
            });

            // Get 5 top posts : Get from social
            $topPostList = $this->getArticlesFilter(0, 5, $newestArticles);

            // Get 9 newest posts
            $newPostList = $this->getArticlesFilter(5, 9, $newestArticles);

            // Get 4 focus posts
            $focusPostList = $this->getArticlesFilter(14, 5, $newestArticles);


            // Get another posts
            $anotherPostList = $this->getArticlesFilter(19, 15, $newestArticles);

            $anotherPostListWeb = array_chunk($anotherPostList, 5);

            usort($filteredCategory, function ($itemFirst, $itemSecond) {
               return $itemFirst['priority'] > $itemSecond['priority'];
            });

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

    private function getArticlesFilter($offset, $length, $list)
    {
        $i = 0;

        $result = [];

        while ($i < $length) {
            $result[] = $list[$offset];
            $offset++;
            $i++;
        }

        return $result;
    }
}
