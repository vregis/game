<?php

namespace common\models;

use common\models\helpers\Session;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class QuestGameTour extends \common\models\generated\QuestGameTour
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
        $start = new self();
        $start->game_id = Session::getByKey(Session::CURRENT_GAME_ID);
        $start->tour_id = $id;
        $start->user_id = Session::getUserId();
        $start->save();
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
            'user_id' => Session::getUserId(),
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

}