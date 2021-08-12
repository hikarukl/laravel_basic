<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstants;
use Illuminate\Http\Request;
use App\Services\Category as CategoryService;
use App\Services\Post as PostService;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var PostService
     */
    protected $postService;

    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    /**
     * Show list post of current cate
     *
     *
     */
    public function show(Request $request, $slug)
    {
        try {
            $options = [
                'category_slug' => $slug,
                'limit'         => CommonConstants::DEFAULT_LIMIT_SEARCH_HOME
            ];
            $postList = $this->postService->getAllListPagination($options);
            $categoryList = $this->categoryService->getAllCategory();

            $data = [
                'post_list'     => $postList,
                'recent_posts'  => $this->postService->getRecentPosts(),
                'category_list' => $categoryList,
                'category'      => $categoryList->where('slug', $slug)->first()
            ];
            return view('pages.category.index', $data);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ": Has error.");
            Log::error($e->getMessage());
        }
    }
}
