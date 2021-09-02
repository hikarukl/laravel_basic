<?php


namespace App\Helpers;


use App\Constants\CommonConstant;

class DomainHelper
{
    public static function getRequestApiDomain()
    {
        $currentRequestDomain = \request()->getHttpHost();
        $humorDomainHost = substr(env('DOMAIN_HUMOR_SHARE'), strrpos(env('DOMAIN_HUMOR_SHARE'),"/") + 1);
        $pattern = "/($humorDomainHost)/";
        if (preg_match($pattern, $currentRequestDomain)) {
            return env('API_PREFIX_HUMOR_URL', "http://103.57.208.205:8080/");
        }

        return env('API_PREFIX_URL', "http://103.57.208.205:8080/");
    }

    public static function getRequestShareUrl($type)
    {
        $currentRequestDomain = \request()->getHttpHost();
        $humorDomainHost = substr(env('DOMAIN_HUMOR_SHARE'), strrpos(env('DOMAIN_HUMOR_SHARE'),"/") + 1);
        $pattern = "/($humorDomainHost)/";
        if (preg_match($pattern, $currentRequestDomain)) {
            if ($type == CommonConstant::SHARE_TYPE_VIDEO) {
                return self::getRequestApiDomain() . CommonConstant::URL_REQUEST_HUMOR_VIDEO_DETAIL;
            }
            return self::getRequestApiDomain() . CommonConstant::URL_REQUEST_HUMOR_PICTURE_DETAIL;
        }

        // Default
        if ($type == CommonConstant::SHARE_TYPE_VIDEO) {
            return self::getRequestApiDomain() . CommonConstant::URL_REQUEST_VIDEO_DETAIL;
        }
        return self::getRequestApiDomain() . CommonConstant::URL_REQUEST_ARTICLE_DETAIL;
    }
}