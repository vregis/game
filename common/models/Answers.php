<?php

namespace common\models;

use common\models\helpers\Session;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;

class Answers extends generated\Answers
{

    public int $qId;

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

    public static function getAnswersByQuestionId($questionId): ?array
    {
        return self::find()->where(['question_id' => $questionId])->all();
    }

    public static function checkAnswer(int $questionId, string $answer)
    {
        $answers = self::getAnswersByQuestionId($questionId);

        $isCorrect = 0;

        $lgs = new LineGameStats();
        $lgs->answer = $answer;
        $lgs->question_id = $questionId;
        $lgs->user_id = Session::getUserId();
        $lgs->game_id = Session::getByKey(Session::CURRENT_GAME_ID);

        if ($answers) {
            foreach ($answers as $ans) {
                if (mb_strtolower($ans->text, 'UTF-8') == mb_strtolower($answer, 'UTF-8')) {
                    $isCorrect = 1;
                }
            }
        }

        $lgs->is_correct = $isCorrect;

        $lgs->save();

    }

    public static function getTourAnswerList(int $tourId): array
    {
        $answerArray = [];
        $answers = self::find()->where(['tour_id' => $tourId])->all();

        if ($answers) {
            foreach ($answers as $answer) {
                $answerArray[$answer->question_id] = $answer->text;
            }
        }

        return $answerArray;
    }

    public static function getAnswerByTourId(int $tourId, string $answer): ?array
    {
        return self::find()
            ->select('answers.*, questions.id as qId')
            ->leftJoin('questions', 'questions.id = answers.question_id')
            ->where(
                [
                    'answers.text' => $answer,
                    'questions.tour_id' => $tourId
                ]
            )->all();
    }
}