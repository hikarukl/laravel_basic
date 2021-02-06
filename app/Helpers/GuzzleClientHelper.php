<?php


namespace App\Helpers;

use GuzzleHttp\Client;


class GuzzleClientHelper
{
    /**
     * Handle send request get
     *
     * @array $params
     *
     * @return mixed
     *
     */
    public static function sendRequestGetClientGuzzle($params)
    {
        try
        {
            $client = new Client();

            $option = isset($params['query']) ? $params['query'] : [];

            $response = $client->request(
                'GET',
                $params['url'],
                $option
            );

            return (string)$response->getBody();
        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage()
            ];
        }
    }

}