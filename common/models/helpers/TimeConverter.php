<?php

namespace common\models\helpers;

class TimeConverter
{
    public static function secToTime($seconds) {
        if ($seconds < 0) {
            return 0; // защита от дурака
        }

        $hours = floor($seconds / 3600); // берём целые часы
        $minutes = floor(($seconds % 3600) / 60); // оставшиеся минуты
        $secondsLeft = $seconds % 60; // и секунды, которые не влезли

        return sprintf("%02d:%02d:%02d", $hours, $minutes, $secondsLeft); // форматируем под красоту
    }

    public static function secToStr($secs): string
    {
        $res = '';

        $days = floor($secs / 86400);
        $secs = $secs % 86400;
        $res .= self::numWord($days, array('день', 'дня', 'дней')) . ', ';

        $hours = floor($secs / 3600);
        $secs = $secs % 3600;
        $res .= self::numWord($hours, array('час', 'часа', 'часов')) . ', ';

        $minutes = floor($secs / 60);
        $secs = $secs % 60;
        $res .= self::numWord($minutes, array('минута', 'минуты', 'минут')) . ', ';

        $res .= self::numWord($secs, array('секунда', 'секунды', 'секунд'));

        return $res;
    }

    public static function numWord($value, $words, $show = true): string
    {
        $num = $value % 100;
        if ($num > 19) {
            $num = $num % 10;
        }

        $out = ($show) ?  $value . ' ' : '';
        switch ($num) {
            case 1:  $out .= $words[0]; break;
            case 2:
            case 3:
            case 4:  $out .= $words[1]; break;
            default: $out .= $words[2]; break;
        }

        return $out;
    }

    public static function secondsToTime($seconds): string
    {
        if (!is_numeric($seconds)) {
            return "00:00:00";
        }

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
}