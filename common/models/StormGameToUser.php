<?php

namespace common\models;

use common\models\helpers\Session;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class StormGameToUser extends \common\models\generated\StormGameToUser
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function startGame(int $id)
    {
        $game = new self();
        $game->game_id = $id;
        $game->user_id = Session::getUserId();
        $game->save();

        $session = \Yii::$app->session;
        $session->set(Session::CURRENT_GAME_ID, $game->id);

    }

    public static function getRealGameId(int $currentGameId)
    {
        return self::findOne(['id' => $currentGameId]);
    }
}