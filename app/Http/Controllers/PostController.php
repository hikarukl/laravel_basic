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

        // Related articles
        $offsetNewest = 0;
        $numberArticleNewestLength = 20;
        if ($categorySlug == 'moi-nhat') {
            $count = count($newestArticles);
            if ($count <= 80) {
                $articleList = array_slice($newestArticles, 0, $count);
                $numberArticleNewestLength = 0;
            } else {
                $articleList = array_slice($newestArticles, 0, 80);
                $numberArticleNewestLength = $count - 80;
                $offsetNewest = 80;
            }
        } else {
            $articleList = $this->articleService->getArticleBaseOnCategorySlug($categorySlug);
        }

        // Get 20 newest articles
        $newArticleList = array_slice($newestArticles, $offsetNewest, $numberArticleNewestLength);

        // Get 5 newest current articles
        $topArticles = array_slice($articleList, 0, 5);

        $response = [
            'category_list'     => $allCategories,
            'menu_list'         => $filteredCategory,
            'category_selected' => $categorySlug,
            'category_name'     => $categorySlug == 'moi-nhat' ? "Mới Nhất" : $topArticles[0]['category']['name'],
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

    public function instantArticles()
    {
        // Request get call categories
        $allCategories = $this->categoryService->getAllCategories();

        // Request get newest 100 articles
        $newestArticles = $this->articleService->getArticles();

        // Get 9 newest articles
        $newPostList = array_slice($newestArticles, 0, 20);

        $response = [
            'articles'      => $newPostList,
            'category_list' => $allCategories,
            'title'         => "Instant Articles"
        ];

        return view('pages.posts.instant-articles', $response);
    }
}
