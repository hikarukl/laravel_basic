<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstant;
use Illuminate\Http\Request;
use App\Helpers\GuzzleClientHelper;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Home page
     *
     *
     */
    public function index()
    {
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

        // Request get articles
        $params = [
            'url' => CommonConstant::URL_REQUEST_ARTICLES
        ];
        $responseArticles = GuzzleClientHelper::sendRequestGetClientGuzzle($params);

        if (is_array($responseArticles)) {
            Log::error(__FUNCTION__ . ": Request get articles was fail.");

            return view('errors.500');
        }

        $articleInfo = json_decode($responseArticles, true);
        $articleList = $articleInfo['results'];

        // Get 5 top posts
        $topPostList = array_slice($articleList, 0, 5);
        // Get 4 focus posts
        $focusPostList = array_slice($articleList, 5, 5);
        // Get 9 newest posts
        $newPostList = array_slice($articleList, 10, 9);
        // Get another posts
        $anotherPostList = array_slice($articleList, 19, 15);
        $anotherPostListWeb = array_chunk($anotherPostList, 5);

        $response = [
            'category_list'            => $categoryList,
            'top_post_list'            => $topPostList,
            'focus_post_list'          => $focusPostList,
            'new_post_list'            => $newPostList,
            'another_post_list'        => $anotherPostListWeb,
            'another_post_list_mobile' => $anotherPostList,
        ];
        return view('pages.home.index', $response);
    }
}
