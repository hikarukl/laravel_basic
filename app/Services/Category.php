<?php


namespace App\Services;


use App\Constants\CommonConstant;
use App\Helpers\GuzzleClientHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Category
{
    const CATEGORY_LIFE_ID = 2;
    const CATEGORY_HEALTHY_ID = 3;
    const CATEGORY_VIETNAM_START_ID = 4;
    const CATEGORY_SOCIAL_ID = 6;
    const CATEGORY_START_ID = 7;
    const CATEGORY_LAW_ID = 10;
    const CATEGORY_MOVIE_ID = 11;
    const CATEGORY_FOOTBALL_ID = 14;
    const CATEGORY_BACKEND_ID = 17;
    const CATEGORY_FASHION_ID = 18;
    const CATEGORY_HOUSE_HOUSE_ID = 19;
    const CATEGORY_MOBILE_ID = 25;
    const CATEGORY_NETWORK_HOT_ID = 26;
    const CATEGORY_FUNNY_TECHNICAL_ID = 21;
    const CATEGORY_WORLD_ID = 13;
    const CATEGORY_2TEK_ID = 23;

    const CATEGORY_LIST_FILTER_MAP = [
        self::CATEGORY_SOCIAL_ID,
        self::CATEGORY_WORLD_ID,
        self::CATEGORY_FOOTBALL_ID,
        self::CATEGORY_LAW_ID,
        self::CATEGORY_LIFE_ID,
        self::CATEGORY_HEALTHY_ID,
        self::CATEGORY_2TEK_ID,
        //self::CATEGORY_VIETNAM_START_ID,
        //self::CATEGORY_MOVIE_ID,
        //self::CATEGORY_FASHION_ID,
        //self::CATEGORY_FUNNY_TECHNICAL_ID,
    ];

    const CATEGORY_LIST_CONTENT_FILTER_MAP = [
        self::CATEGORY_FOOTBALL_ID,
        self::CATEGORY_FUNNY_TECHNICAL_ID,
        self::CATEGORY_LIFE_ID,
        self::CATEGORY_BACKEND_ID,
        self::CATEGORY_HOUSE_HOUSE_ID,
        self::CATEGORY_MOBILE_ID,
        self::CATEGORY_NETWORK_HOT_ID,
        self::CATEGORY_LAW_ID,
        self::CATEGORY_MOVIE_ID,
        self::CATEGORY_VIETNAM_START_ID,
        self::CATEGORY_START_ID,
        self::CATEGORY_HEALTHY_ID,
        self::CATEGORY_FASHION_ID,
        self::CATEGORY_SOCIAL_ID,
    ];

    /**
     * Description
     *
     *
     * @return array
     *
     */
    public function getAllCategories()
    {
        try {
            /*if (Cache::has(CommonConstant::CACHE_GET_CATEGORIES_NAME)) {
                return Cache::get(CommonConstant::CACHE_GET_CATEGORIES_NAME);
            }

            // Request get categories
            $params = [
                'url' => env('API_PREFIX_URL', "http://10.104.0.2/") . CommonConstant::URL_REQUEST_CATEGORIES
            ];
            $responseCategory = GuzzleClientHelper::sendRequestGetClientGuzzle($params);

            $categoryInfo = json_decode($responseCategory, true);
            $categoryList = collect($categoryInfo['results']);

            $categoryListArr = $categoryList->groupBy('id')->toArray();
            $result = [];
            foreach ($categoryListArr as $key => $item) {
                $result[$key] = $item[0];
            }

            Cache::put(
                CommonConstant::CACHE_GET_CATEGORIES_NAME,
                $result,
                now()->addMinutes(CommonConstant::CACHE_CATEGORIES_EXPIRE_IN_MINUTES)
            );*/

            return CommonConstant::CATEGORY_LIST_MAP;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return [];
        }
    }
}