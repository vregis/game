<?php

namespace frontend\controllers;

use common\models\Answers;
use common\models\Games;
use common\models\helpers\Session;
use common\models\QuestGameStats;
use common\models\QuestGameTour;
use common\models\QuestGameToUser;
use common\models\Questions;
use common\models\StormGameStats;
use common\models\StormGameToUser;
use common\models\Tours;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class StormController extends FrontendController
{
    public function actionNewGame($id)
    {
        $game = Games::getGameByUrl($id);

        if (!$game) {
            throw new NotFoundHttpException('Игры не существует');
        }

        return $this->render('new-game', ['game' => $game]);
    }

    public function actionGameStart()
    {
        $response['success'] = false;

        if (empty($_POST['id'])) {
            return json_encode($response);
        }

        $game = Games::getGameById($_POST['id']);

        if (!$game) {
            return json_encode($response);
        }


        StormGameToUser::startGame($game->id);

        $tours = Tours::getToursByGameId($game->id);

        if (!$tours) {
            $response['success'] = false;
            return json_encode($response);
        }


        $response['success'] = true;
        $response['url'] = Url::to(['/storm/tour', 'id' => $tours[0]->id]);

        return json_encode($response);

    }

    public function actionTour($id)
    {
        $tour = Tours::getTourById($id);
        if (!$tour) {
            throw new NotFoundHttpException('Tour not found');
        }

        $tours = Tours::getToursByGameId($tour->game_id);

        if (!$tours) {
            throw new NotFoundHttpException('Tours not found');
        }

        $questions = Questions::getQuestionsByTourId($tour->id);

        if (!$questions) {
            throw new NotFoundHttpException('Questions not found');
        }

        return $this->render('tour', ['tour' => $tour, 'questions' => $questions, 'tours' => $tours]);
    }

    public function actionSendAnswer()
    {
        $response['success'] = false;

        if (empty($_POST['tour_id']) || empty($_POST['answer'])) {
            return json_encode($response);
        }

        $answers = Answers::getAnswerByTourId($_POST['tour_id'], $_POST['answer']);

        StormGameStats::updateStats($_POST['tour_id'], $_POST['answer'], $answers);

        $response['success'] = true;

        if (!$answers) {
            $response['is_correct'] = false;
            return json_encode($response);
        }

        $response['is_correct'] = true;
        return json_encode($response);

    }

    public function actionUpdateStat()
    {
        $response['success'] = false;

        if (empty($_POST['tour_id'])) {
            return json_encode($response);
        }

        $stat = StormGameStats::getCurrentStat($_POST['tour_id']);
        $answeredQuestions = [];

        $isEnd = 0;
        if ($stat){

            foreach ($stat as $question) {
                $answeredQuestions[$question->question_id] = $question->answer;
            }
        }

        $timeEnd = StormGameStats::getRemainingTime();

        $isEnd = $timeEnd == 0 ?  1 :  0;

        $count = Questions::getQuestionByTourCount($_POST['tour_id']);

        if ($count === count($stat)) {
            $isEnd = 1;
        }

        $correctResponse = [
            'isEnd' => $isEnd,
            'questions' => $answeredQuestions,
            'time' => $timeEnd
        ];

        return json_encode($correctResponse);
    }

    public function actionGameEnd()
    {
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $realGameId = StormGameToUser::getRealGameId($gameId);
        $tourList = Tours::getToursByGameId($realGameId->game_id);
        $correctAnswers = StormGameStats::getCorrectAnswers();

        return $this->render('end-game', ['tourList' => $tourList, 'correctAnswers' => $correctAnswers]);
    }
}