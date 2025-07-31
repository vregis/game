<?php

namespace common\models;

use common\models\helpers\Session;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

class QuestGameTeamTour extends generated\QuestGameTeamTour
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
    public static function tourStart($id)
    {
        $exist = QuestGameTeamTour::find()->where(['tour_id' => $id, 'game_id' =>  Session::getByKey(Session::CURRENT_GAME_ID), 'team_id' => TeamToUser::getTeamFromUser(Session::getUserId())])->exists();
        if (!$exist) {
            $start = new self();
            $start->game_id = Session::getByKey(Session::CURRENT_GAME_ID);
            $start->tour_id = $id;
            $start->team_id = TeamToUser::getTeamFromUser(Session::getUserId());
            $start->save();
        }

    }

    public static function tourEnd($id)
    {
        $end = self::getCurrentTour($id);

        if ($end) {
            $end->end_at = new Expression('NOW()');
            $end->save();
        }
    }

    public static function getCurrentTour(int $tourId)
    {
        return self::find()->where([
            'tour_id' => $tourId,
            'game_id' => Session::getByKey(Session::CURRENT_GAME_ID),
            'team_id' => TeamToUser::getTeamFromUser(Session::getUserId()),
            'end_at' => null,
        ])->one();
    }

    public static function getRemainingTime(int $tourId): int
    {
        $start = self::getCurrentTour($tourId);
        $tour = Tours::getTourById($tourId);

        if (!$start || !$tour) {
            return 0;
        }

        $gameTime = time() - strtotime($start->created_at);

        if ($gameTime > $tour->time) {
            return 0;
        }

        return $tour->time - $gameTime;
    }

    public static function isGameExist()
    {
        $teamId = TeamToUser::getTeamFromUser(Session::getUserId());
        if (!$teamId) {
            return false;
        }

        return self::find()->where(['team_id' => $teamId, 'end_at' => null])->one();
    }
}