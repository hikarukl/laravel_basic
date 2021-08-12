<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostShowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Post as PostService;
use App\Services\Category as CategoryService;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected $postService;
    /**
     * @var CategoryService
     */
    protected $categoryService;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function show(PostShowRequest $request, $slug)
    {
        try {
            $data = [
                'post'          => $this->postService->detailBySlug($slug),
                'recent_posts'  => $this->postService->getRecentPosts(),
                'category_list' => $this->categoryService->getAllCategory()
            ];

            // Increase view number
            $data['post']->number_views += 1;
            $data['post']->save();

            return view('pages.post.show', $data);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ": Has error.");
        }
    }
}
