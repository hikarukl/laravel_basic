<?php


namespace App\Helpers;


use App\Constants\CommonConstant;
use Illuminate\Support\Carbon;

class PostHelper
{
    const LIMIT_DISPLAY_DAY_FORMAT = 3;

    /**
     * Display time for post
     *
     * @string $time
     *
     * @return string
     *
     */
    public static function convertTimeToDisplay($time)
    {
        $time = Carbon::parse($time);
        $now = now();

        if ($now->diffInDays($time) > self::LIMIT_DISPLAY_DAY_FORMAT) {
            return $time->timezone(CommonConstant::DEFAULT_TIMEZONE)->format('d/m/Y H:i');
        }

        if ($now->diff($time)->d == 0) {
            if ($now->diff($time)->h == 0) {
                return $now->diff($time)->i . ' phút trước';
            }

            return $now->diff($time)->h . ' giờ trước';
        }

        return $now->diff($time)->d . ' ngày ' . $now->diff($time)->h . ' giờ trước';
    }

    public static function convertTimeInstantArticle($time, $type)
    {
        $time = Carbon::parse($time);

        return $time->format($type);
    }
}