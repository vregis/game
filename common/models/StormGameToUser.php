<?php

namespace common\models;

use common\models\helpers\Session;
use common\models\helpers\TimeConverter;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class StormGameToUser extends \common\models\generated\StormGameToUser
{
    public string $userName;
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'start_at',
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

    public static function endGame(int $gameId, int $userId)
    {
        $game = self::findOne(['id' => $gameId, 'user_id' => $userId]);
        $game->end_at = new Expression('NOW()');
        $game->save();
    }

    public static function getGameStats(int $gameId): array
    {
        return self::find()
            ->select('storm_game_to_user.*, user.username as userName')
            ->join('LEFT JOIN', 'user', 'storm_game_to_user.user_id = user.id')
            ->where(['storm_game_to_user.game_id' => $gameId])
            ->andWhere(['not', ['storm_game_to_user.end_at' => null]])
            ->andWhere(['<>', 'storm_game_to_user.user_id', 1])
            ->andWhere(['<>', 'storm_game_to_user.user_id', 2])
            ->andWhere(['<>', 'storm_game_to_user.user_id', 16])
            ->andWhere(['<>', 'storm_game_to_user.user_id', 26])
            ->all();
    }

    public static function calculateTime($timeStart, $timeEnd): string
    {
        return TimeConverter::secondsToTime((strtotime($timeEnd) - strtotime($timeStart)));
    }

    public static function endTime()
    {
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $userId = Session::getUserId();
        $game = self::findOne(['id' => $gameId, 'user_id' => $userId]);
        $game->end_at = new Expression('NOW()');
        $game->save();
    }

}