<?php

namespace common\models\helpers;

use Yii;

class Session
{

    const CURRENT_GAME_ID = 'game_id';

    public static function getByKey($key)
    {
        return Yii::$app->session->get($key);
    }

    public static function getUserId()
    {
       // return 1;
        return Yii::$app->user->id;
    }
}