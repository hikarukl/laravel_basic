<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstant;
use App\Helpers\GuzzleClientHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class RssController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Get instant articles
     *
     */
    public function instantArticles()
    {
        // Request get call categories
        $params = [
            'url' => env('API_PREFIX_URL', "http://10.104.0.2/") . CommonConstant::URL_REQUEST_INSTANT_ARTICLES
        ];

        /*$result = GuzzleClientHelper::sendRequestGetClientGuzzle($params);
        return view('pages.posts.instant-articles-server', ['data' => $result]);*/

        return redirect($params['url']);
    }
}
