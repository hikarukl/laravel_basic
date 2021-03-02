<?php


namespace App\Constants;


class CommonConstant
{
    const URL_REQUEST_CATEGORIES = "http://139.59.117.80/kenh14/categories/";
    const URL_REQUEST_ARTICLES = "http://139.59.117.80/kenh14/articles/";
    const URL_REQUEST_ARTICLE_DETAIL = "http://139.59.117.80/kenh14/article/id";
    const URL_REQUEST_ARTICLE_CATEGORY = "http://139.59.117.80/kenh14/category-articles/slug";
    const URL_REQUEST_HOST = "http://139.59.117.80/";

    // Cache
    const CACHE_HOME_NAME = "GET_HOME_INFORMATION";
    const CACHE_HOME_EXPIRE_IN_MINUTES = 20;
    const CACHE_CATEGORIES_EXPIRE_IN_MINUTES = 60*24*30;
    const CACHE_ARTICLE_DETAIL_EXPIRE_IN_MINUTES = 60*24;
    const MIN_ARTICLES_NEED_TO_DISPLAY = 5;

    // Cache article detail prefix
    const CACHE_ARTICLE_PREFIX_NAME = "GET_ARTICLE_DETAIL_";
    // Cache article list all
    const CACHE_ARTICLE_LIST_NAME = "GET_ARTICLE_LIST";
    // Cache article base on category slug
    const CACHE_ARTICLE_CATEGORY_PREFIX_NAME = "GET_ARTICLE_CATEGORY_";

    const CACHE_GET_CATEGORIES_NAME = "GET_CATEGORIES";

    const DEFAULT_TIMEZONE = 'Asia/Ho_Chi_Minh';
}