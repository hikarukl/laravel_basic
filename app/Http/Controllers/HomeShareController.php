<?php

namespace App\Http\Controllers;

use App\Constants\CommonConstant;

class HomeShareController extends Controller
{
   public function index()
   {
       $currentRequestDomain = \request()->getHttpHost();
       $humorDomainHost = substr(env('DOMAIN_HUMOR_SHARE'), strrpos(env('DOMAIN_HUMOR_SHARE'),"/") + 1);
       $pattern = "/($humorDomainHost)/";
       if (preg_match($pattern, $currentRequestDomain)) {
           $response = [
               'app_name'        => 'Hài 24h',
               'app_desc'        => 'App xem clip hình ảnh hài. Cập nhật liên tục các clip hình ảnh hài mới nhất, chất nhất.',
               'app_summary'     => 'Luôn cập nhật các clip hỉnh ảnh hài hay và mới nhất',
               'icon_app_circle' => asset('images/humor/icon_app_circle.png'),
               'ios_app_link'    => CommonConstant::URL_IOS_HUMOR_APP,
               'ios_app_qrcode'  => asset('images/humor/qr_ios_app.jpg'),
               'view_resource'   => 'humor',
               'common_bg_color' => 'bg-orange_custom_two',
           ];
       } else {
           $response = [
               'app_name'        => 'Tin Hay 24h',
               'app_desc'        => 'App đọc tin hay. Cập nhật liên tục các tin mới nhất, hot nhất.',
               'app_summary'     => 'Luôn cập nhật các tin hot và mới nhất',
               'icon_app_circle' => asset('images/ico_app_circle.png'),
               'ios_app_link'    => CommonConstant::URL_IOS_APP,
               'ios_app_qrcode'  => asset('images/qr_ios_app.png'),
               'view_resource'   => 'web_news',
               'common_bg_color' => 'bg-green_custom_two',
           ];
       }

        return view('pages.home_share.index', $response);
   }
}
