<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstant;
use App\Helpers\GuzzleClientHelper;
use App\Helpers\SignatureHelper;
use App\Services\Article;
use App\Services\Category;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManagerStatic;

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

        $newestArticles = array_filter($newestArticles, function ($item) {
            return  in_array($item['category']['id'], array_keys(CommonConstant::CATEGORY_LIST_MAP));
        });

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
        $firstArticle = Arr::first($topArticles);

        usort($filteredCategory, function ($itemFirst, $itemSecond) {
            return $itemFirst['priority'] > $itemSecond['priority'];
        });
        $response = [
            'category_list'     => $allCategories,
            'menu_list'         => $filteredCategory,
            'category_selected' => $categorySlug,
            'category_name'     => $categorySlug == 'moi-nhat' ? "Mới Nhất" : $allCategories[$firstArticle['category']['id']]['name'],
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
            if (!$id) {
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

            if ($articleDetail['thumbnail']) {
                $thumbExtension = pathinfo($articleDetail['thumbnail'], PATHINFO_EXTENSION);
                $imageSaveName = md5($articleDetail['slug']) . "." . $thumbExtension;
            } else {
                $articleDetail['thumbnail'] = asset('images/thumb_post_default.png');
                $imageSaveName = "thumb_post_default.png";
            }

            if (!file_exists(public_path("images/post_og"))) {
                mkdir(public_path("images/post_og"));
            }

            if (!file_exists(public_path("images/post_og/{$imageSaveName}"))) {
                if ($articleDetail['thumbnail']) {
                    ImageManagerStatic::make($articleDetail['thumbnail'])
                        ->resize(1200, 675)
                        ->save(public_path("images/post_og/{$imageSaveName}"));
                } else {
                    if (!file_exists(public_path("images/post_og/{$imageSaveName}"))) {
                        ImageManagerStatic::make(public_path("images/thumb_post_default.png"))
                            ->resize(1200, 675)
                            ->save(public_path("images/post_og/{$imageSaveName}"));
                    }
                }
            }

            $articleDetail['post_og_img'] = $imageSaveName;

            // Request get newest 100 articles
            $newestArticles = $this->articleService->getArticles();

            $newestArticles = array_filter($newestArticles, function ($item) {
                return  in_array($item['category']['id'], array_keys(CommonConstant::CATEGORY_LIST_MAP));
            });

            // Get 9 newest articles
            $newPostList = array_slice($newestArticles, 0, 20);

            // Related articles
            $relatedArticles = $this->articleService->getArticleBaseOnCategorySlug($category);

            // Get 10 related posts
            $relatedArticleList = array_slice($relatedArticles, 0, 10);
            $relatedArticleList = collect($relatedArticleList)->filter(function ($item) use ($articleDetail) {
               return $item['id'] != $articleDetail['id'];
            })->toArray();

            usort($filteredCategory, function ($itemFirst, $itemSecond) {
                return $itemFirst['priority'] > $itemSecond['priority'];
            });

            // Share link
            $shareLink = env('DOMAIN_SHARE') . "/share/{$articleDetail['id']}";
            $response = [
                'category_list'     => $allCategories,
                'category_selected' => $category,
                'menu_list'         => $filteredCategory,
                'post'              => $articleDetail,
                'new_post_list'     => $newPostList,
                'related_post_list' => array_slice($relatedArticleList, 0, 6),
                'share_link'        => $shareLink
            ];

            return view('pages.posts.detail', $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return view('errors.500');
        }
    }

    public function shareArticle(Request $request, $id)
    {
        try {
            if (!$id) {
                throw new \Exception("Invalid id.");
            }

            $currentRequestDomain = \request()->getHttpHost();
            $humorDomainHost = substr(env('DOMAIN_HUMOR_SHARE'), strrpos(env('DOMAIN_HUMOR_SHARE'),"/") + 1);
            $pattern = "/($humorDomainHost)/";
            if (preg_match($pattern, $currentRequestDomain)) {
                $type = CommonConstant::SHARE_TYPE_PICTURE;
            } else {
                $type = CommonConstant::SHARE_TYPE_ARTICLE;
            }

            $response = $this->getResponseShare($type, $id);

            return view('pages.posts.share', $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return view('errors.500');
        }
    }

    public function shareVideo(Request $request, $id)
    {
        try {
            if (!$id) {
                throw new \Exception("Invalid id.");
            }

            $response = $this->getResponseShare("video", $id);

            return view('pages.posts.share', $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return view('errors.500');
        }
    }

    private function getResponseShare($type, $id)
    {
        // Request get call categories
        $allCategories = $this->categoryService->getAllCategories();

        // Request get detail
        $articleDetail = $this->articleService->getArticleDetail($id, $type, true);

        if (empty($articleDetail)) {
            Log::error(__FUNCTION__ . ": Request get {$type} was fail.");

            return view('errors.500');
        }
        // Check thumbnail article
        if ($type == CommonConstant::SHARE_TYPE_ARTICLE) {
            if (
                !isset($articleDetail['thumbnail']) && !isset($articleDetail['thumbnail_url'])
            ) {
                $articleDetail['thumbnail'] = asset('images/thumb_post_default.png');
            }
        }

        $currentRequestDomain = \request()->getHttpHost();
        $humorDomainHost = substr(env('DOMAIN_HUMOR_SHARE'), strrpos(env('DOMAIN_HUMOR_SHARE'),"/") + 1);
        $pattern = "/($humorDomainHost)/";
        if (preg_match($pattern, $currentRequestDomain)) {
            $defaultResponse = [
                'app_name'        => 'Hài 24h',
                'header_app_desc' => 'App Hài 24h',
                'ios_app_link'    => CommonConstant::URL_IOS_HUMOR_APP,
                'common_bg_color' => CommonConstant::HUMOR_COLOR_COMMON_BG,
                'icon_app_circle' => asset('images/humor/icon_app_circle.png')
            ];
            $isi = CommonConstant::IOS_ISI_HUMOR;
            $package = CommonConstant::IOS_PACKAGE_HUMOR;
        } else {
            $defaultResponse = [
                'app_name'        => 'Tin Hay 24h',
                'header_app_desc' => 'App đọc tin hay',
                'ios_app_link'    => CommonConstant::URL_IOS_APP,
                'common_bg_color' => CommonConstant::NEWS_COLOR_COMMON_BG,
                'icon_app_circle' => asset('images/ico_app_circle.png')
            ];
            $isi = CommonConstant::IOS_ISI_NEWS;
            $package = CommonConstant::IOS_PACKAGE_NEWS;
        }

        $shareLink = $type === "video" ? $type : "share";
        $urlIosDynamicLink = str_replace(
            ["{type}", "{id}", "{isi}", "{package}"],
            [$shareLink, $id, $isi, $package],
            CommonConstant::URL_DYNAMIC_LINK
        );

        return array_merge($defaultResponse, [
            'category_list'     => $allCategories,
            'post'              => $articleDetail,
            'ios_dynamic_link'  => $urlIosDynamicLink,
            'share_type'        => $type
        ]);
    }

    public function instantArticles()
    {
        // Create facebook instance
        $fb = new Facebook([
            'app_id'                => env('FACEBOOK_APP_ID'),
            'app_secret'            => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.10',
        ]);
        $pageId = env('FACEBOOK_PAGE_ID');

        // Request get call categories
        $allCategories = $this->categoryService->getAllCategories();

        // Request get newest 100 articles
        $newestArticles = $this->articleService->getArticles();

        $newestArticles = array_filter($newestArticles, function ($item) {
            return  in_array($item['category']['id'], array_keys(CommonConstant::CATEGORY_LIST_MAP));
        });

        // Get 9 newest articles
        $newPostList = array_slice($newestArticles, 0, 11);

        $filterPost = [];
        foreach ($newPostList as $post) {
            $detail = $this->articleService->getArticleDetail($post['id']);
            $detail['category'] = $post['category'];

            $contentHtml = response()->view('pages.posts._rss', ['article' => $detail, 'category_list' => $allCategories])->content();

            try {
                $responseIa = $fb->post("/{$pageId}/instant_articles", [
                    'html_source'      => $contentHtml,
                    'published'        => false,
                    'development_mode' => false,
                    'access_token'     => env('FACEBOOK_APP_ACCESS_TOKEN')
                ]);

                Log::info("Create ia: " . $responseIa->getBody());
            } catch (\Exception $e) {
                Log::error($e->getMessage());

                return response()->json([
                    'status'  => 1,
                    'message' => "Thất bại."
                ]);
            }
        }

        return response()->json([
            'status'  => 1,
            'message' => "Thành công."
        ]);
    }
}
