<?php


namespace App\Services;


use App\Constants\CommonConstant;
use App\Helpers\GuzzleClientHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class Article
{
    const DEFAULT_LIMIT_GET_ARTICLES = 100;
    const DEFAULT_START_OFFSET = 0;

    /**
     * Get articles with conditions
     *
     * @param array $options
     *
     * @return array
     *
     */
    public function getArticles($options = [])
    {
        try {
            if (Cache::has(CommonConstant::CACHE_ARTICLE_LIST_NAME)) {
                return Cache::get(CommonConstant::CACHE_ARTICLE_LIST_NAME);
            }

            // Request get categories
            $params = [
                'url'   => CommonConstant::URL_REQUEST_ARTICLES,
                'query' => [
                    'limit'  => isset($options['limit']) ? $options['limit'] :  self::DEFAULT_LIMIT_GET_ARTICLES,
                    'offset' => isset($options['offset']) ? $options['offset'] : self::DEFAULT_START_OFFSET
                ]
            ];

            $result = $this->getArticlesRequest($params);

            Cache::put(
                CommonConstant::CACHE_ARTICLE_LIST_NAME,
                $result,
                now()->addMinutes(CommonConstant::CACHE_HOME_EXPIRE_IN_MINUTES)
            );

            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return [];
        }
    }

    /**
     * Get articles of specific category
     *
     * @param string $categorySlug
     *
     * @return array
     *
     */
    public function getArticleBaseOnCategorySlug($categorySlug)
    {
        try {
            $cacheName = CommonConstant::CACHE_ARTICLE_CATEGORY_PREFIX_NAME . $categorySlug;
            if (Cache::has($cacheName)) {
                return Cache::get($cacheName);
            }

            // Request get categories
            $params = [
                'url'   => str_replace("slug", $categorySlug, CommonConstant::URL_REQUEST_ARTICLE_CATEGORY),
            ];

            $result = $this->getArticlesRequest($params);

            Cache::put(
                $cacheName,
                $result,
                now()->addMinutes(CommonConstant::CACHE_HOME_EXPIRE_IN_MINUTES)
            );

            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return [];
        }
    }

    /**
     * Get article detail
     *
     * @param int $articleId
     *
     * @return array
     *
     */
    public function getArticleDetail($articleId)
    {
        try {
            $cacheName = CommonConstant::CACHE_ARTICLE_PREFIX_NAME . $articleId;
            if (Cache::has($cacheName)) {
                return Cache::get($cacheName);
            }

            $params = [
                'url' => str_replace("id", $articleId, CommonConstant::URL_REQUEST_ARTICLE_DETAIL)
            ];

            $responsePost = GuzzleClientHelper::sendRequestGetClientGuzzle($params);

            $result = json_decode($responsePost, true);

            Cache::put(
                $cacheName,
                $result,
                now()->addMinutes(CommonConstant::CACHE_HOME_EXPIRE_IN_MINUTES)
            );

            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return [];
        }
    }

    /**
     * Get post base on slugs but call async
     *
     * @param array $categoryList
     *
     * @return array
     *
     */
    public function getArticleBaseOnCategorySlugAsync($categoryList)
    {
        try {
            $cacheName = CommonConstant::CACHE_ARTICLE_CATEGORY_PREFIX_NAME . "ASYNC";
            if (Cache::has($cacheName)) {
                return Cache::get($cacheName);
            }

            // Request get categories
            $client = new Client(['base_uri' => CommonConstant::URL_REQUEST_HOST]);

            $promises = [];
            foreach ($categoryList as $cateId => $category) {
                $promises[$cateId] = $client->getAsync("/kenh14/category-articles/{$category}");
            }

            $responseData = Promise\Utils::unwrap($promises);

            $result = [];
            foreach ($responseData as $cateId => $data) {
                $dataArr = json_decode((string)$data->getBody(), true);
                $dataParsed = $dataArr['results'];

                foreach ($dataParsed as $offset => $article) {
                    if (empty($article['category'])) {
                        $dataParsed[$offset]['category'] = [
                            'id'   => Category::CATEGORY_SOCIAL_ID,
                            'name' => "Xã hội"
                        ];
                    }
                }
                $result[$cateId] = $dataParsed;
            }

            Cache::put(
                $cacheName,
                $result,
                now()->addMinutes(CommonConstant::CACHE_HOME_EXPIRE_IN_MINUTES)
            );

            return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return [];
        }
    }

    private function getArticlesRequest($params)
    {
        $responseArticles = GuzzleClientHelper::sendRequestGetClientGuzzle($params);

        $articleList = json_decode($responseArticles, true);
        $articleList = $articleList['results'];

        foreach ($articleList as $key => $article) {
            if (empty($article['category'])) {
                $articleList[$key]['category'] = [
                    'id'   => Category::CATEGORY_SOCIAL_ID,
                    'name' => "Xã hội"
                ];
            }
        }

        return $articleList;
    }
}