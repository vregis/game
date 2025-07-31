<?php

namespace common\models;

use Yii;
use common\models\helpers\Session;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class QuestGameTeamToUser extends \common\models\generated\QuestGameTeamToUser
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
        $game->user_id = TeamToUser::getTeamFromUser(Session::getUserId());
        if (!$game->save()) {
            var_dump($game->errors);
            die();
        }

        $session = Yii::$app->session;
        $session->set(Session::CURRENT_GAME_ID, $game->id);

    }

    public static function getRealGameId(int $currentGameId)
    {
        return self::findOne(['id' => $currentGameId]);
    }
}