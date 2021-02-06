<?php


namespace App\Services;


use App\Constants\CommonConstant;
use App\Helpers\GuzzleClientHelper;
use Illuminate\Support\Facades\Log;

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
            // Request get categories
            $params = [
                'url'   => CommonConstant::URL_REQUEST_ARTICLES,
                'query' => [
                    'limit'  => isset($options['limit']) ? $options['limit'] :  self::DEFAULT_LIMIT_GET_ARTICLES,
                    'offset' => isset($options['offset']) ? $options['offset'] : self::DEFAULT_START_OFFSET
                ]
            ];

            return $this->getArticleRequest($params);
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
            // Request get categories
            $params = [
                'url'   => str_replace("slug", $categorySlug, CommonConstant::URL_REQUEST_ARTICLE_CATEGORY),
            ];

            return $this->getArticleRequest($params);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return [];
        }
    }

    private function getArticleRequest($params)
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