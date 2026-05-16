<?php

namespace common\models;

use common\models\helpers\Session;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class QuestGameToUser extends \common\models\generated\QuestGameToUser
{

    public $duration;

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

        $session = Yii::$app->session;
        $session->set(Session::CURRENT_GAME_ID, $game->id);

    }

    public static function getRealGameId(int $currentGameId)
    {
        return self::findOne(['id' => $currentGameId]);
    }

    public static function endGame()
    {
        $game = self::findOne(['id' => Session::getByKey(Session::CURRENT_GAME_ID)]);
        $game->end_at = new Expression('NOW()');
        $game->save();
    }

    public static function addBonus($bonus)
    {
        $game = self::findOne(['id' => Session::getByKey(Session::CURRENT_GAME_ID)]);
        $game->bonus = $game->bonus + $bonus;
        $game->save();
    }
}