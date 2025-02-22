<?php

namespace frontend\controllers;

use common\models\helpers\Session;
use common\models\Team;
use common\models\TeamInvintation;
use common\models\TeamToUser;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends FrontendController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Team models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userId = Session::getUserId() ?? null;

        if ($userId === null) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Team::find()->where(['creator_id' => $userId]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        $teams = Team::getTeamsByUserId(Session::getUserId());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'teams' => $teams,
        ]);
    }

    /**
     * Displays a single Team model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Team();

        if ($this->request->isPost) {
            $model->creator_id = Session::getUserId();
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Team model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Team model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddInvite()
    {
        if (!$_POST['id'] || !$_POST['team_id']) {
            $response['success'] = false;
            $response['message'] = 'Произошла ошибка';
            return json_encode($response);
        }

        if (TeamInvintation::issetInvite($_POST['team_id'], Session::getUserId(),$_POST['id'])) {
            $response['success'] = false;
            $response['message'] = 'Приглашение уже существует';
            return json_encode($response);
        }

        $model = new TeamInvintation();
        $model->team_id = $_POST['team_id'];
        $model->invitor_id = Session::getUserId();
        $model->user_id = $_POST['id'];

        if ($model->save()) {
            $response['success'] = true;
            $response['message'] = 'Приглашение отправлено';
        } else {
            $response['success'] = false;
            $response['message'] = 'Произошла ошибка';
        }

        return json_encode($response);
    }

    public function actionInvite()
    {
        $inviteList = TeamInvintation::getInviteList(Session::getUserId());
        return $this->render('invite', ['inviteList' => $inviteList]);
    }

    public function actionAnswerInvite()
    {
        if (!$_POST['id'] || !$_POST['status']) {
            $response['msg'] = 'Произошла ошибка';
            return json_encode($response);
        }

        $invite = TeamInvintation::findOne(['id' => $_POST['id']]);

        if (!$invite) {
            $response['msg'] = 'Произошла ошибка';
            return json_encode($response);
        }

        $invite->status = $_POST['status'];
        $ok = Team::addTeam($invite->user_id, $invite->team_id);

        if (!$ok) {
            $response['msg'] = 'Произошла ошибка';
            return json_encode($response);
        }

        if ($invite->save()) {
            if ($_POST['status'] == 1) {
                $response['msg'] = 'Вы вступили в команду';
            } else {
                $response['msg'] = 'Вы отказались';
            }
        } else {
            $response['msg'] = 'Произошла ошибка';
        }

        return json_encode($response);
    }

    public function actionDeleteTeam()
    {
        if (!$_POST['id']) {
            $response['msg'] = 'Произошла ошибка';
            return json_encode($response);
        }

        if (TeamToUser::deleteAll(['id' => $_POST['id']])) {
            $response['msg'] = 'Вы покинули команду';
            return json_encode($response);
        }

        $response['msg'] = 'Произошла ошибка';
        return json_encode($response);
    }

    public function actionTeamPlayers(int $id)
    {
        $team = Team::findOne($id);
        if (!$team) {
            throw new NotFoundHttpException();
        }

        $players = Team::getPlayersByTeamId($id);

        return $this->render('team-players', ['team' => $team, 'players' => $players]);
    }
}
