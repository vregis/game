<?php

namespace frontend\controllers;

use common\models\Answers;
use common\models\Games;
use common\models\GameToUser;
use common\models\helpers\Session;
use common\models\helpers\TimeConverter;
use common\models\Prompts;
use common\models\QuestGameStats;
use common\models\QuestGameTour;
use common\models\QuestGameToUser;
use common\models\Questions;
use common\models\StormGameStats;
use common\models\StormGameToUser;
use common\models\Tours;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class StormController extends FrontendController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['new-game'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['new-game'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
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
        $response['msg'] = 'Произошла ошибка';

        if (empty($_POST['id'])) {
            return json_encode($response);
        }

        $game = Games::getGameById($_POST['id']);

        if (!$game) {
            return json_encode($response);
        }

        $isExist = StormGameToUser::find()->where(['game_id' => $game->id, 'user_id' => Yii::$app->user->id, 'end_at' => null])->one();

        if ($isExist) {
            $response['msg'] = 'Данный пользователь уже участвует в игре';
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

        $disabledTours = StormGameStats::getDisabledTours();

        return $this->render('tour', ['tour' => $tour, 'questions' => $questions, 'tours' => $tours, 'disabledTours' => $disabledTours]);
    }

    public function actionSendAnswer()
    {
        $switchTour = 0;
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
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $userId = Session::getUserId();
        $gameToUser = StormGameToUser::find()->where(['id' => $gameId, 'user_id' => $userId])->one();
        $switchTour = 0;
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

        if ($timeEnd == 0) {
            $isEnd = 1;

            StormGameToUser::endGame($gameId, $userId);

        }

        $count = Questions::getQuestionByTourCount($_POST['tour_id']);
        $tour = Tours::getTourById($_POST['tour_id']);

        if (StormGameStats::isGameEnd()) {
            $isEnd = 1;
        } else {
            if ($count === count($answeredQuestions)) {
                StormGameStats::updateRemainingTimeTour($_POST['tour_id']);
                $switchTour = StormGameStats::switchTour();

            }elseif(time() - strtotime($gameToUser->start_at) > $tour->time && $tour->time !== null && $tour->time !== '') {
                $switchTour = StormGameStats::switchTour(true);
            }
        }

        $correctResponse = [
            'isEnd' => $isEnd,
            'questions' => $answeredQuestions,
            'time' => TimeConverter::secondsToTime($timeEnd),
            'switchTour' => $switchTour,
        ];

        return json_encode($correctResponse);
    }

    public function actionGameEnd()
    {
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $realGameId = StormGameToUser::getRealGameId($gameId);
        $tourList = Tours::getToursByGameId($realGameId->game_id);
        $correctAnswers = StormGameStats::getCorrectAnswers();
        $gameResults = StormGameToUser::getGameStats($realGameId->game_id);

        return $this->render('end-game', ['tourList' => $tourList, 'correctAnswers' => $correctAnswers, 'gameResults' => $gameResults]);
    }

    public function actionPrompts()
    {
        $gameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $start = StormGameToUser::getRealGameId($gameId);
        $promts = Prompts::find()->all();
        $response = [];

        if($promts) {
            foreach ($promts as $prompt) {
                $pTime = time() - strtotime($start->start_at);
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