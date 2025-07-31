<?php

namespace frontend\controllers;

use common\models\Answers;
use common\models\Games;
use common\models\helpers\Session;
use common\models\helpers\TimeConverter;
use common\models\Prompts;
use common\models\QuestGameTeamStats;
use common\models\QuestGameTeamTour;
use common\models\QuestGameTeamToUser;
use common\models\Questions;
use common\models\Tours;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class QuestTeamController extends FrontendController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['new-game'],
                'rules' => [
                    [
                        'actions' => ['new-game'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
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

        $tour = Tours::getNextTour($game->id);

        if (!$tour) {
            return json_encode($response);
        }

        QuestGameTeamToUser::startGame($game->id);

        $response['success'] = true;
        $response['url'] = Url::to(['/quest-team/new-tour', 'id' => $tour->id]);

        return json_encode($response);

    }

    public function actionNewGame($id)
    {
        $game = Games::getGameByUrl($id);

        if (!$game) {
            throw new NotFoundHttpException('Игры не существует');
        }

        if ($game = QuestGameTeamTour::isGameExist()) {
            $session = Yii::$app->session;
            $session->set(Session::CURRENT_GAME_ID, $game->game_id);
            //redirect to needed tour
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

        QuestGameTeamTour::tourStart($tour->id);

        $response['success'] = true;
        $response['url'] = Url::to(['/quest-team/tour', 'id' => $tour->id]);

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

        QuestGameTeamStats::updateStats($_POST['tour_id'], $_POST['answer'], $answers);

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

        $stat = QuestGameTeamStats::getCurrentStat($_POST['tour_id']);
        $answeredQuestions = [];

        if ($stat){
            foreach ($stat as $question) {
                $answeredQuestions[$question->question_id] = $question->answer;
            }
        }

        $timeEnd = QuestGameTeamTour::getRemainingTime($_POST['tour_id']);

        $isEnd = $timeEnd == 0 ?  1 :  0;

        $count = Questions::getQuestionByTourCount($_POST['tour_id']);

        if ($count === count($stat)) {
            $isEnd = 1;
        }

        $correctResponse = [
            'isEnd' => $isEnd,
            'questions' => $answeredQuestions,
            'time' => TimeConverter::secToTime($timeEnd),
        ];

        return json_encode($correctResponse);
    }

    public function actionEndTour(int $id)
    {
        $count = Questions::getQuestionByTourCount($id);
        $stat = QuestGameTeamStats::getCurrentStat($id);
        $tour = Tours::getTourById($id);
        QuestGameTeamTour::tourEnd($id);

        if (!$stat || count($stat) < $count) {
           // $this->redirect(['/quest/tour', 'id' => $id]);
        }

        $allStat = QuestGameTeamStats::getAllStats($id);
        $nextTour = Tours::getNextTour($tour->game_id, $tour->number);

        return $this->render('end-tour', ['allStat' => $allStat, 'nextTour' => $nextTour]);
    }

    public function actionGameStat()
    {
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $realGameId = QuestGameTeamToUser::getRealGameId($gameId);
        $tourList = Tours::getToursByGameId($realGameId->game_id);
        $correctAnswers = QuestGameTeamStats::getCorrectAnswers();

        return $this->render('end-game', ['tourList' => $tourList, 'correctAnswers' => $correctAnswers]);
    }

    public function actionPrompts()
    {
        $start = QuestGameTeamTour::getCurrentTour($_POST['tour_id']);
        $promts = Prompts::find()->all();
        $response = [];

        if($promts) {
            foreach ($promts as $prompt) {
                $pTime = time() - strtotime($start->created_at);
                $time = $prompt->time - $pTime;
                if ($time < 0) {
                    $time = 0;
                }
                $response['prompts'][$prompt->id]['time'] = $time;
            }
        }

        return json_encode($response);


    }
}