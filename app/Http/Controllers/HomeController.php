<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstants;
use Illuminate\Http\Request;

use App\Services\FrontendMenu as FrontendMenuService;
use App\Services\Post as PostService;

class HomeController extends Controller
{
    protected $frontendMenuService;
    /**
     * @var PostService
     */
    protected $postService;

    public function __construct(FrontendMenuService $frontendMenuService, PostService $postService)
    {
        $this->frontendMenuService = $frontendMenuService;
        $this->postService = $postService;
    }

    /**
     * Description
     *
     *
     */
    public function index()
    {
        $options = [
            'limit' => CommonConstants::DEFAULT_LIMIT_SEARCH_HOME
        ];
        $data = [
            'post_list'    => $this->postService->getAllListPagination($options),
            'recent_posts' => $this->postService->getRecentPosts()
        ];

        return view('pages.home.index', $data);
    }

    public function show()
    {
        return view('pages.home.show');
    }
}
