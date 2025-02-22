<?php

namespace common\models;

use common\models\helpers\Session;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class QuestGameStats extends \common\models\generated\QuestGameStats
{

    const DEFAULT_BONUS_TIME = 10;

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

    public static function updateStats(int $tourId, string $userAnswer, ?array $answers)
    {
        if (!$answers) {
            self::addIncorrectAnswer($tourId, $userAnswer);
        } else {
            self::addCorrectAnswer($tourId, $userAnswer, $answers);
        }
    }

    private static function addIncorrectAnswer(int $tourId, string $userAnswer)
    {
        $stat = new self();
        $stat->tour_id = $tourId;
        $stat->user_id = Session::getUserId();
        $stat->answer = $userAnswer;
        $stat->game_id = Session::getByKey(Session::CURRENT_GAME_ID);
        $stat->question_id = 0;
        $stat->is_correct = 0;

        $stat->save();
    }

    private static function addCorrectAnswer(int $tourId, string $userAnswer, array $answers)
    {
        $questionsId = self::getQuestionsId($answers);
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $userId = Session::getUserId();

        foreach ($questionsId as $questionId) {
            $stat = new self();
            $stat->tour_id = $tourId;
            $stat->user_id = $userId;
            $stat->answer = $userAnswer;
            $stat->game_id = $gameId;
            $stat->question_id = $questionId;

            if (self::getDublicate($tourId, $questionId)) {
                $stat->is_correct = 2;
            } else {
                $stat->is_correct = 1;
                self::updateRemainingTime($gameId, $tourId, $userId, $questionId);
            }


            $stat->save();
        }
    }

    public static function getDublicate(int $tourId, int $questionId)
    {
        return self::find()->where([
            'tour_id' => $tourId,
            'question_id' => $questionId,
            'game_id' => Session::getByKey(Session::CURRENT_GAME_ID),
            'is_correct' => 1,
            'user_id' => Session::getUserId()
        ])->one();
    }

    private static function getQuestionsId(array $answers): array
    {
        $questionsId = [];
        foreach ($answers as $answer) {
            $questionsId[] = $answer->question_id;
        }

        return $questionsId;
    }

    public static function getCurrentStat(int $tourId): ?array
    {
        return self::find()->where([
            'tour_id' => $tourId,
            'is_correct' => 1,
            'user_id' => Session::getUserId(),
            'game_id' => Session::getByKey(Session::CURRENT_GAME_ID),
        ])->all();
    }

    public static function getAllStats(int $tourId): array
    {
        return self::find()->where([
            'tour_id' => $tourId,
            'game_id' => Session::getByKey(Session::CURRENT_GAME_ID),
            'user_id' => Session::getUserId()
        ])->all();
    }

    public static function getCorrectAnswers(): array
    {
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);

        $answerList =  self::find()->select('question_id')->where([
            'quest_game_stats.game_id' => $gameId,
            'quest_game_stats.user_id' => Session::getUserId(),
            'quest_game_stats.is_correct' => 1
        ])->all();

        return self::answerListToArray($answerList);
    }

    private static function answerListToArray($answerList): array
    {
        $answerArray = [];
        foreach ($answerList as $answer) {
            $answerArray[] = $answer->question_id;
        }

        return $answerArray;
    }

    private static function updateRemainingTime(int $gameId, int $tourId, int $userId, int $questionId): void
    {
        $q = Questions::findOne($questionId);
        $bonus = self::DEFAULT_BONUS_TIME;

        if ($q) {
            $bonus += $q->bonus;
        }

        \Yii::$app->getDb()->createCommand('UPDATE `quest_game_tour` SET created_at = DATE_ADD(created_at, INTERVAL '.$bonus.' second) WHERE game_id = '.$gameId.' AND tour_id = '.$tourId.' AND user_id = '.$userId)->execute();
    }

}