<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostShowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Post as PostService;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function show(PostShowRequest $request, $slug)
    {
        try {
            $data = [
                'post'         => $this->postService->detailBySlug($slug),
                'recent_posts' => $this->postService->getRecentPosts()
            ];

            // Increase view number


            return view('pages.post.show', $data);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ": Has error.");
        }
    }
}
