<?php

namespace frontend\controllers;

use common\models\Answers;
use common\models\Games;
use common\models\GameToUser;
use common\models\helpers\Session;
use common\models\QuestGameStats;
use common\models\QuestGameTour;
use common\models\QuestGameToUser;
use common\models\Questions;
use common\models\Tours;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class QuestController extends FrontendController
{
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

        $tour = Tours::getNextTour($game->id);

        if (!$tour) {
            return json_encode($response);
        }

        QuestGameToUser::startGame($game->id);


        $response['success'] = true;
        $response['url'] = Url::to(['/quest/new-tour', 'id' => $tour->id]);

        return json_encode($response);

    }

    public function actionNewGame($id)
    {
        $game = Games::getGameByUrl($id);

        if (!$game) {
            throw new NotFoundHttpException('Игры не существует');
        }

        return $this->render('new-game', ['game' => $game]);
    }

    public function actionNewTour($id)
    {
        $tour = Tours::getTourById($id);

        if (!$tour) {
            throw new NotFoundHttpException('Тура не существует');
        }

        return $this->render('new-tour', ['tour' => $tour]);
    }

    public function actionTourStart()
    {
        $response['success'] = false;

        if (empty($_POST['id'])) {
            return json_encode($response);
        }

        $tour = Tours::getTourById($_POST['id']);

        if (!$tour) {
            return json_encode($response);
        }

        QuestGameTour::tourStart($tour->id);

        $response['success'] = true;
        $response['url'] = Url::to(['/quest/tour', 'id' => $tour->id]);

        return json_encode($response);
    }

    public function actionTour($id)
    {
        $tour = Tours::getTourById($id);
        if (!$tour) {
            throw new NotFoundHttpException('Tour not found');
        }

        $questions = Questions::getQuestionsByTourId($tour->id);


        if (!$questions) {
            throw new NotFoundHttpException('Questions not found');
        }

        return $this->render('tour', ['tour' => $tour, 'questions' => $questions]);
    }

    public function actionSendAnswer()
    {
        $response['success'] = false;

        if (empty($_POST['tour_id']) || empty($_POST['answer'])) {
            return json_encode($response);
        }

        $answers = Answers::getAnswerByTourId($_POST['tour_id'], $_POST['answer']);

        QuestGameStats::updateStats($_POST['tour_id'], $_POST['answer'], $answers);

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

        $stat = QuestGameStats::getCurrentStat($_POST['tour_id']);
        $answeredQuestions = [];

        if ($stat){
            foreach ($stat as $question) {
                $answeredQuestions[$question->question_id] = $question->answer;
            }
        }

        $timeEnd = QuestGameTour::getRemainingTime($_POST['tour_id']);

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

    public function actionEndTour(int $id)
    {
        $count = Questions::getQuestionByTourCount($id);
        $stat = QuestGameStats::getCurrentStat($id);
        $tour = Tours::getTourById($id);
        QuestGameTour::tourEnd($id);

        if (!$stat || count($stat) < $count) {
           // $this->redirect(['/quest/tour', 'id' => $id]);
        }

        $allStat = QuestGameStats::getAllStats($id);
        $nextTour = Tours::getNextTour($tour->game_id, $tour->number);

        return $this->render('end-tour', ['allStat' => $allStat, 'nextTour' => $nextTour]);
    }

    public function actionGameStat()
    {
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $realGameId = QuestGameToUser::getRealGameId($gameId);
        $tourList = Tours::getToursByGameId($realGameId->game_id);
        $correctAnswers = QuestGameStats::getCorrectAnswers();

        return $this->render('end-game', ['tourList' => $tourList, 'correctAnswers' => $correctAnswers]);
    }
}