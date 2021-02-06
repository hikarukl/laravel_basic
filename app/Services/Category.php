<?php


namespace App\Services;


use App\Constants\CommonConstant;
use App\Helpers\GuzzleClientHelper;
use Illuminate\Support\Facades\Log;

class Category
{
    const CATEGORY_LIFE_ID = 2;
    const CATEGORY_HEALTHY_ID = 3;
    const CATEGORY_START_ID = 4;
    const CATEGORY_SOCIAL_ID = 6;
    const CATEGORY_LAW_ID = 10;
    const CATEGORY_MOVIE_ID = 11;
    const CATEGORY_FOOTBALL_ID = 14;
    const CATEGORY_FASHION_ID = 18;
    const CATEGORY_FUNNY_TECHNICAL_ID = 21;

    const CATEGORY_LIST_FILTER_MAP = [
        self::CATEGORY_LIFE_ID,
        self::CATEGORY_HEALTHY_ID,
        self::CATEGORY_START_ID,
        self::CATEGORY_SOCIAL_ID,
        self::CATEGORY_LAW_ID,
        self::CATEGORY_MOVIE_ID,
        self::CATEGORY_FOOTBALL_ID,
        self::CATEGORY_FASHION_ID,
        self::CATEGORY_FUNNY_TECHNICAL_ID,
    ];

    /**
     * Description
     *
     * @param boolean $isFilter true then filter some specific categories
     *
     * @return array
     *
     */
    public function getAllCategories($isFilter = true)
    {
        try {
            // Request get categories
            $params = [
                'url' => CommonConstant::URL_REQUEST_CATEGORIES
            ];
            $responseCategory = GuzzleClientHelper::sendRequestGetClientGuzzle($params);

            $categoryInfo = json_decode($responseCategory, true);
            $categoryList = collect($categoryInfo['results']);

            if ($isFilter) {
                $categoryList = $categoryList->filter( function ($item) {
                    return in_array($item['id'], self::CATEGORY_LIST_FILTER_MAP);
                });

            }

            return $categoryList->groupBy('id')->toArray();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return [];
        }
    }
}