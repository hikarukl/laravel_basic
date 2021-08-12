<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CommonConstants;
use App\Http\Requests\PostShowRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Services\Post;
use App\Services\Category;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PostController
{
    /**
     * @var Post
     */
    protected $postService;

    /**
     * @var Category
     */
    protected $categoryService;

    public function __construct(Post $postService, Category $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    /**
     * Show list
     *
     */
    public function index(Request $request)
    {
        try {
            /*$dataReceived = $request->getQueryString()? Query::parse($request->getQueryString()) : [];

            $dataSearch = [
                'limit' => isset($dataReceived['limit']) && $dataReceived['limit'] ? $dataReceived['limit'] : CommonConstants::DEFAULT_LIMIT_SEARCH,
            ];

            $dataSearch = array_merge($dataReceived, $dataSearch);

            $data['post_list'] = $this->postService->getAllListPagination($dataSearch)
                ->appends(request()->query());*/

            return view("admin.post.index", ['post_list' => '']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
        }
    }

    public function show(PostShowRequest $request, $id)
    {
        try {
            if (!$id || !is_numeric($id)) {
               throw new \Exception("Invalid search param: {$id}");
            }

            // Get post detail
            $postCacheKey = str_replace("{ID}", $id, CommonConstants::CACHE_POST_DETAIL_NAME);
            if (Cache::has($postCacheKey)) {
                $postDetail = Cache::get($postCacheKey);
            } else {
                $postDetail = \App\Models\Post::find($id);
                Cache::put($postCacheKey, $postDetail, CommonConstants::CACHE_DEFAULT_EXPIRED_MINUTES);
            }

            $data = [
                'post_detail' => $postDetail
            ];
            return view('admin.post.show', $data);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . " - " . __FUNCTION__ . ": Has error.");
            Log::error($e->getMessage());

            return redirect()->route('dashboard.index');
        }
    }

    /**
     * Show page create new posts
     *
     */
    public function create()
    {
        // Get category list
        $categoryList = $this->categoryService->getAllCategory(['status' => CommonConstants::STATUS_ACTIVE_NUMBER]);

        $data = [
            'category_list' => $categoryList
        ];

        return view('admin.post.create', $data);
    }

    public function edit(PostShowRequest $request, $id)
    {
        try {
            if (!$id || !is_numeric($id)) {
                throw new \Exception("Invalid search param: {$id}");
            }

            // Get post detail
            $postCacheKey = str_replace("{ID}", $id, CommonConstants::CACHE_POST_DETAIL_NAME);
            if (Cache::has($postCacheKey)) {
                $postDetail = Cache::get($postCacheKey);
            } else {
                $postDetail = \App\Models\Post::find($id);
            }

            // Get category list
            $categoryList = $this->categoryService->getAllCategory(['status' => CommonConstants::STATUS_ACTIVE_NUMBER]);

            $data = [
                'post'          => $postDetail,
                'category_list' => $categoryList,
            ];
            return view('admin.post.edit', $data);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . " - " . __FUNCTION__ . ": Has error.");
            Log::error($e->getMessage());

            return redirect()->route('dashboard.index');
        }
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            if (!$id || !is_numeric($id)) {
                throw new \Exception("Invalid update param: {$id}");
            }

            $postCacheKey = str_replace("{ID}", $id, CommonConstants::CACHE_POST_DETAIL_NAME);
            if (Cache::has($postCacheKey)) {
                $postDetail = Cache::get($postCacheKey);
            } else {
                $postDetail = \App\Models\Post::find($id);
            }

            $dataReceived = $request->all();

            $dataUpdate = [];
            foreach ($dataReceived as $key => $val) {
                if (preg_match("/^(post_)(.*)/", $key, $matches)) {
                    $dataUpdate[$matches[2]] = $val;
                }
            }
            $dataUpdate['status'] = isset($dataReceived['post_status']) ? CommonConstants::STATUS_ACTIVE_NUMBER : CommonConstants::STATUS_INACTIVE_NUMBER;

            if (isset($dataReceived['post_thumbnail']) && $dataReceived['post_thumbnail'] instanceof UploadedFile) {
                $fileName = "post_thumbnail_{$id}." . $dataReceived['post_thumbnail']->getClientOriginalExtension();
                $filePath = "post_thumbnails_" . date('Ym');
                $dataUpdate['thumbnail'] = $dataReceived['post_thumbnail']->storePubliclyAs($filePath, $fileName, ['disk' => 'public']);
            }

            $postDetail->update($dataUpdate);

            return redirect()->route("admin-post.edit", ['admin_post' => $postDetail->id]);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . " - " . __FUNCTION__ . ": Has error.");
            Log::error($e->getMessage());

            return redirect()->route('dashboard.index');
        }
    }

    public function store(PostStoreRequest $request)
    {
        try {
            $dataReceived = $request->all();

            $post = new \App\Models\Post();
            $dataStore = [
                'title'       => $dataReceived['post_title'],
                'admin_id'    => auth()->user()->getAuthIdentifier(),
                'slug'        => $dataReceived['post_slug'],
                'content'     => $dataReceived['post_content'],
                'description' => $dataReceived['post_description'],
                'category_id' => $dataReceived['post_category_id'],
                'tags'        => $dataReceived['post_tags'],
                'status'      => isset($dataReceived['post_status']) ? CommonConstants::STATUS_ACTIVE_NUMBER : CommonConstants::STATUS_INACTIVE_NUMBER,
            ];
            $postId = $post->insertGetId($dataStore);

            if (isset($dataReceived['post_thumbnail']) && $dataReceived['post_thumbnail'] instanceof UploadedFile) {
                $fileName = "post_thumbnail_{$postId}." . $dataReceived['post_thumbnail']->getClientOriginalExtension();
                $filePath = "post_thumbnails_" . date('Ym');
                $dataUpdate['thumbnail'] = $dataReceived['post_thumbnail']->storePubliclyAs($filePath, $fileName, ['disk' => 'public']);
                \App\Models\Post::find($postId)->update($dataUpdate);
            }

            return redirect()->route("admin-post.create")->with('message', 'Create post was success!');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . " - " . __FUNCTION__ . ": Has error.");
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()->withErrors("Fail.");
        }
    }

    public function ajaxGetList(Request $request)
    {
        try {
            $dataReceived = $request->getQueryString()? Query::parse($request->getQueryString()) : [];

            $dataSearch = [
                'limit' => isset($dataReceived['limit']) && $dataReceived['limit'] ? $dataReceived['limit'] : CommonConstants::DEFAULT_LIMIT_SEARCH,
            ];

            $dataSearch = array_merge($dataReceived, $dataSearch);

            $postList = $this->postService->getAllListPagination($dataSearch)
                ->appends(request()->query());

            $postList->map(function ($item) {
                $item->url_edit = route('admin-post.edit', ['admin_post' => $item->id]);

                return $item;
            });

           $response = [
               'data'      => $postList->all(),
               'last_page' => $postList->lastPage()
           ];

            return response()->json($response);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
        }
    }
}
