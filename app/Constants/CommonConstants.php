<?php

namespace App\Constants;

class CommonConstants
{
    const DEFAULT_LIMIT_SEARCH = 10;
    const DEFAULT_LIMIT_SEARCH_HOME = 20;
    const DEFAULT_SEARCH_LIMIT_LIST = [
        10,
        25,
        50,
        100
    ];
    const STATUS_ACTIVE_NUMBER = 1;
    const STATUS_INACTIVE_NUMBER = 0;

    // Cache name
    const CACHE_DEFAULT_EXPIRED_MINUTES = 30*24*60; // 30 days
    const CACHE_EXPIRED_10_MINUTES = 10;

    const CACHE_POST_DETAIL_NAME = 'CACHE_POST_DETAIL_{ID}';
    const CACHE_POST_RECENT_NAME = 'CACHE_POST_RECENT';
    const CACHE_CATEGORY_LIST_NAME = 'CACHE_CATEGORY_LIST';
}