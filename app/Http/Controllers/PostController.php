<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstant;
use App\Helpers\GuzzleClientHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Show post when press category
     *
     *
     */
    public function index()
    {
        return view('pages.posts.index');
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

            // Request get categories
            $params = [
                'url' => CommonConstant::URL_REQUEST_CATEGORIES
            ];
            $responseCategory = GuzzleClientHelper::sendRequestGetClientGuzzle($params);

            if (is_array($responseCategory)) {
                Log::error(__FUNCTION__ . ": Request get categories was fail.");

                return view('errors.500');
            }

            $categoryInfo = json_decode($responseCategory, true);
            $categoryList = collect($categoryInfo['results']);
            $categoryList = $categoryList->groupBy('id')->toArray();


            // Request get detail
            $params = [
                'url' => str_replace("id", $id, CommonConstant::URL_REQUEST_ARTICLE_DETAIL)
            ];

            $responsePost = GuzzleClientHelper::sendRequestGetClientGuzzle($params);

            if (is_array($responsePost)) {
                Log::error(__FUNCTION__ . ": Request get post was fail.");

                return view('errors.500');
            }

            $postInfo = json_decode($responsePost, true);

            // Request get articles
            $params = [
                'url' => CommonConstant::URL_REQUEST_ARTICLES
            ];
            $responseArticles = GuzzleClientHelper::sendRequestGetClientGuzzle($params);
            $articleInfo = json_decode($responseArticles, true);
            $articleList = $articleInfo['results'];

            // Get 9 newest posts
            $newPostList = array_slice($articleList, 10, 9);
            // Get 3 related posts
            $relatedPostList = array_slice($articleList, 0, 10);
            $relatedPostList = collect($relatedPostList)->filter(function ($item) use ($postInfo) {
               return $item['id'] != $postInfo['id'];
            })->toArray();

            $response = [
                'category_list'     => $categoryList,
                'post'              => $postInfo,
                'new_post_list'     => $newPostList,
                'related_post_list' => array_slice($relatedPostList, 0, 6),
            ];

            return view('pages.posts.detail', $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return view('errors.500');
        }
    }
}
