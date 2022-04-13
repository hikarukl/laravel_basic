<?php


namespace App\Constants;


class CommonConstant
{
    const URL_REQUEST_CATEGORIES = "kenh14/categories/";
    const URL_REQUEST_ARTICLES = "kenh14/articles/";
    const URL_REQUEST_ARTICLE_DETAIL = "kenh14/article/{id}/";
    const URL_REQUEST_VIDEO_DETAIL = "video/GetVideoDetail/{id}/";
    const URL_REQUEST_ARTICLE_CATEGORY = "kenh14/category-articles/slug/";
    const URL_REQUEST_INSTANT_ARTICLES = "rssfeeds/instant-articles";
    const URL_REQUEST_HOST = "http://103.57.208.205/";
    const URL_DYNAMIC_LINK = "https://tinhay24.page.link/?link=https://trangthudo.com/{type}/{id}&isi={isi}&ibi={package}&cid=5476314331837942920&_icp=1&efr=1";
    const URL_IOS_APP = "https://apps.apple.com/vn/app/id1576498863#?platform=iphone";
    const URL_IOS_HUMOR_APP = "https://apps.apple.com/vn/app/id1583362092#?platform=iphone";
    const IOS_ISI_NEWS = 1576498863;
    const IOS_ISI_HUMOR = 1583362092;
    const IOS_PACKAGE_NEWS = "com.generlab.tinhay24h";
    const IOS_PACKAGE_HUMOR = "com.generlab.Hai24h";
    const NEWS_COLOR_COMMON_BG = 'bg-green_custom_one';

    // Normal
    const SHARE_TYPE_ARTICLE = 'article';
    const SHARE_TYPE_PICTURE = 'picture';
    const SHARE_TYPE_VIDEO = 'video';

    // Humor
    const URL_REQUEST_HUMOR_PICTURE_DETAIL = "api/pictures/GetDetailPicture/{id}";
    const URL_REQUEST_HUMOR_VIDEO_DETAIL = "api/videos/GetDetailVideo/{id}";
    const HUMOR_COLOR_COMMON_BG = 'bg-orange_custom_one';


    // Cache
    const CACHE_HOME_NAME = "GET_HOME_INFORMATION";
    const CACHE_HOME_EXPIRE_IN_MINUTES = 5;
    const CACHE_CATEGORIES_EXPIRE_IN_MINUTES = 60*24*30;
    const CACHE_ARTICLE_DETAIL_EXPIRE_IN_MINUTES = 10;
    const CACHE_ARTICLE_SHARE_EXPIRE_IN_MINUTES = 60*24*30;
    const MIN_ARTICLES_NEED_TO_DISPLAY = 5;

    // Cache article detail prefix
    const CACHE_ARTICLE_PREFIX_NAME = "GET_ARTICLE_DETAIL_";
    // Cache article list all
    const CACHE_ARTICLE_LIST_NAME = "GET_ARTICLE_LIST";
    // Cache article base on category slug
    const CACHE_ARTICLE_CATEGORY_PREFIX_NAME = "GET_ARTICLE_CATEGORY_";

    const CACHE_GET_CATEGORIES_NAME = "GET_CATEGORIES";

    const DEFAULT_TIMEZONE = 'Asia/Ho_Chi_Minh';

    const CATEGORY_LIST_MAP = [
        1 => [
            "id" => 1,
            "name" => "Làm đẹp",
            "slug" => "lam-dep",
        ],
        2 => [
            "id"        => 2,
            "name"      => "Đời sống",
            "slug"      => "doi-song",
            "priority"  => 5
        ],
        3 => [
            "id"        => 3,
            "name"      => "Sức Khỏe",
            "slug"      => "suc-khoe-gioi-tinh",
            "priority"  => 6
        ],
        4 => [
            "id" => 4,
            "name" => "Sao Việt",
            "slug" => "sao-viet",
        ],
        5 => [
            "id" => 5,
            "name" => "Xem Mua Luôn",
            "slug" => "xem-mua-luon",
        ],
        6 => [
            "id"        => 6,
            "name"      => "Xã Hội",
            "slug"      => "xa-hoi",
            "priority"  => 1
        ],
        7 => [
            "id" => 7,
            "name" => "Star",
            "slug" => "star",
        ],
        8 => [
            "id" => 8,
            "name" => "Việt Nam",
            "slug" => "viet-nam",
        ],
        9 => [
            "id" => 9,
            "name" => "Học Đường",
            "slug" => "hoc-duong",
        ],
        10 => [
            "id"        => 10,
            "name"      => "Pháp Luật",
            "slug"      => "phap-luat",
            "priority"  => 4
        ],
        /*11 => [
            "id" => 11,
            "name" => "Phim Chiếu Rạp",
            "slug" => "phim-chieu-rap",
        ],*/
        12 => [
            "id" => 12,
            "name" => "Series Truyền Hình",
            "slug" => "series-truyen-hinh",
        ],
        13 => [
            "id" => 13,
            "name" => "Thế Giới",
            "slug" => "the-gioi",
            "priority"  => 2
        ],
        14 => [
            "id" => 14,
            "name" => "Bóng Đá",
            "slug" => "bong-da",
            "priority"  => 3
        ],
        15 => [
            "id" => 15,
            "name" => "Châu Á",
            "slug" => "chau-a",
        ],
        16 => [
            "id" => 16,
            "name" => "Star Style",
            "slug" => "star-style",
        ],
        17 => [
            "id" => 17,
            "name" => "Hậu Trường",
            "slug" => "hau-truong",
        ],
        /*18 => [
            "id" => 18,
            "name" => "Thời trang",
            "slug" => "thoi-trang",
        ],*/
        19 => [
            "id" => 19,
            "name" => "House n Home",
            "slug" => "house-n-home",
        ],
        20 => [
            "id" => 20,
            "name" => "TV Show",
            "slug" => "tv-show",
        ],
        /*21 => [
            "id" => 21,
            "name" => "Công Nghệ Vui",
            "slug" => "cong-nghe-vui",
        ],*/
        22 => [
            "id" => 22,
            "name" => "HIP-HOP Neva Die",
            "slug" => "hip-hop-neva-die",
        ],
        23 => [
            "id"        => 23,
            "name"      => "Công Nghệ",
            "slug"      => "2-tek",
            "priority"  => 7
        ],
        24 => [
            "id" => 24,
            "name" => "Cao thủ",
            "slug" => "cao-thu",
        ],
        25 => [
            "id" => 25,
            "name" => "Mobile",
            "slug" => "mobile",
        ],
        26 => [
            "id" => 26,
            "name" => "Nóng Trên Mạng",
            "slug" => "nong-tren-mang",
        ],
        27 => [
            "id" => 27,
            "name" => "Chùm Ảnh",
            "slug" => "chum-anh",
        ],
        28 => [
            "id" => 28,
            "name" => "Sport",
            "slug" => "sport",
        ],
        29 => [
            "id" => 29,
            "name" => "Đẹp",
            "slug" => "dep",
        ],
        30 => [
            "id" => 30,
            "name" => "eSport",
            "slug" => "esport",
        ],
        31 => [
            "id" => 31,
            "name" => "Dị",
            "slug" => "di",
        ],
        32 => [
            "id" => 32,
            "name" => "Ứng Dụng/Thủ Thuật",
            "slug" => "ung-dungthu-thuat",
        ],
        33 => [
            "id" => 33,
            "name" => "Phim Việt Nam",
            "slug" => "phim-viet-nam",
        ],
        34 => [
            "id" => 34,
            "name" => "Nhân Vật",
            "slug" => "nhan-vat",
        ],
        35 => [
            "id" => 35,
            "name" => "Hội bạn thân Showbiz",
            "slug" => "hoi-ban-than-showbiz",
        ],
        36 => [
            "id" => 36,
            "name" => "Âu-Mỹ",
            "slug" => "au-my",
        ],
        37 => [
            "id" => 37,
            "name" => "Hoa Ngữ - Hàn Quốc",
            "slug" => "hoa-ngu-han-quoc",
        ],
        38 => [
            "id" => 38,
            "name" => "Hoa Ngữ - Hàn Quốc",
            "slug" => "hoa-ngu-han-quoc",
        ],
        39 => [
            "id" => 39,
            "name" => "Du Học",
            "slug" => "du-hoc",
        ],
        40 => [
            "id" => 40,
            "name" => "Kiến Thức Giới Tính",
            "slug" => "kien-thuc-gioi-tinh",
        ],
        41 => [
            "id" => 41,
            "name" => "Đấu trường",
            "slug" => "dau-truong",
        ],
        42 => [
            "id" => 42,
            "name" => "Beauty & Fashion",
            "slug" => "beauty-fashion",
        ],
        43 => [
            "id" => 43,
            "name" => "Concept",
            "slug" => "concept",
        ],
        44 => [
            "id" => 44,
            "name" => "Musik",
            "slug" => "musik",
        ],
        45 => [
            "id" => 45,
            "name" => "Tuyển sinh",
            "slug" => "tuyen-sinh",
        ],
        46 => [
            "id" => 46,
            "name" => "Xem-Ăn-Chơi",
            "slug" => "xem-an-choi",
        ],
        48 => [
            "id" => 46,
            "name" => "Kinh Doanh",
            "slug" => "dinh-doanh",
        ]
    ];
}
