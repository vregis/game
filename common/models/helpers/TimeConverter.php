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
}