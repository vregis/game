<?php

namespace common\models;

use common\models\helpers\Session;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class LineGameStats extends \common\models\generated\LineGameStats
{

    public $text;
    public $number;
    public $qId;
    public $tId;

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

    public static function getTourStatistic(int $tourId): ?array
    {
        return self::find()
            ->select('line_game_stats.*, questions.text, questions.number, questions.id as qId')
            ->leftJoin('questions', 'questions.id = line_game_stats.question_id')
            ->where(
            [
                'questions.tour_id' => $tourId,
                'line_game_stats.game_id' => Session::getByKey(Session::CURRENT_GAME_ID),
                'line_game_stats.user_id' => Session::getUserId()
            ]
        )->all();
    }

    public static function getGameStatistic(int $gameId): ?array
    {
        return self::find()
            ->select('line_game_stats.*, questions.text, questions.number, questions.id as qId, questions.tour_id as tId')
            ->leftJoin('questions', 'questions.id = line_game_stats.question_id')
            ->where(
                [
                    'line_game_stats.game_id' => $gameId,
                    'line_game_stats.user_id' => Session::getUserId()
                ]
            )->all();
    }

    public static function getToursList(array $stat): array
    {
        $toursList = [];

        foreach ($stat as $item) {
            if (!in_array($item['tId'], $toursList)) {
                $toursList[] = $item['tId'];
            }
        }

        return $toursList;
    }
}