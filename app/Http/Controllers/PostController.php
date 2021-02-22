<?php

namespace App\Http\Controllers;

use App\Services\Article;
use App\Services\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    protected $categoryService;
    protected $articleService;

    public function __construct(Category $categoryService, Article $articleService)
    {
        $this->categoryService = $categoryService;
        $this->articleService = $articleService;
    }

    /**
     * Show post when press category
     *
     * @param string $categorySlug
     *
     */
    public function index($categorySlug)
    {
        // Request get call categories
        $allCategories = $this->categoryService->getAllCategories();

        // Request get filter categories for main menu display
        $filteredCategory = array_filter($allCategories, function ($item) {
            return in_array($item['id'], Category::CATEGORY_LIST_FILTER_MAP);
        });

        // Request get newest 100 articles
        $newestArticles = $this->articleService->getArticles();

        // Get 20 newest articles
        $newArticleList = array_slice($newestArticles, 0, 20);

        // Related articles
        $articleList = $this->articleService->getArticleBaseOnCategorySlug($categorySlug);

        // Get 5 newest current articles
        $topArticles = array_slice($articleList, 0, 5);

        $response = [
            'category_list'     => $allCategories,
            'menu_list'         => $filteredCategory,
            'category_selected' => $categorySlug,
            'top_post_list'     => $topArticles,
            'new_post_list'     => $newArticleList,
            'related_post_list' => array_slice($articleList, 5)
        ];

        return view('pages.posts.index', $response);
    }

    /**
     * Show post detail when press category
     *
     *
     */
    public function detail(Request $request, $category, $id)
    {
        try {
            if (!$id || !is_numeric($id)) {
                throw new \Exception("Invalid id.");
            }

            // Request get call categories
            $allCategories = $this->categoryService->getAllCategories();

            // Request get filter categories for main menu display
            $filteredCategory = array_filter($allCategories, function ($item) {
                return in_array($item['id'], Category::CATEGORY_LIST_FILTER_MAP);
            });

            // Request get detail
            $articleDetail = $this->articleService->getArticleDetail($id);

            if (empty($articleDetail)) {
                Log::error(__FUNCTION__ . ": Request get article was fail.");

                return view('errors.500');
            }

            // Request get newest 100 articles
            $newestArticles = $this->articleService->getArticles();

            // Get 9 newest articles
            $newPostList = array_slice($newestArticles, 0, 20);

            // Related articles
            $relatedArticles = $this->articleService->getArticleBaseOnCategorySlug($category);

            // Get 10 related posts
            $relatedArticleList = array_slice($relatedArticles, 0, 10);
            $relatedArticleList = collect($relatedArticleList)->filter(function ($item) use ($articleDetail) {
               return $item['id'] != $articleDetail['id'];
            })->toArray();

            $response = [
                'category_list'     => $allCategories,
                'menu_list'         => $filteredCategory,
                'post'              => $articleDetail,
                'new_post_list'     => $newPostList,
                'related_post_list' => array_slice($relatedArticleList, 0, 6),
            ];

            return view('pages.posts.detail', $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return view('errors.500');
        }
    }
}
