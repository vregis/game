<?php

namespace common\models;

use common\models\helpers\Session;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class GameToUser extends generated\GameToUser
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

    public static function startGame(int $gameId)
    {
        $gameToUser = new self();
        $gameToUser->game_id = $gameId;
        $gameToUser->user_id = Session::getUserId();
        $gameToUser->save();

        $session = Yii::$app->session;
        $session->set(Session::CURRENT_GAME_ID, $gameToUser->id);
    }

    public static function getOriginGameId(int $id): int
    {
        return self::findOne(['id' => $id])->game_id;
    }
}