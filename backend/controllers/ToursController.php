<?php

namespace backend\controllers;

use common\models\Games;
use common\models\helpers\UploadFileHelper;
use common\models\TourAttachments;
use common\models\Tours;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToursController implements the CRUD actions for Tours model.
 */
class ToursController extends BackendController
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
     * Lists all Tours models.
     *
     * @return string
     */
    public function actionIndex(int $id): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tours::find()->where(['game_id' => $id]),
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

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Tours model.
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
     * Creates a new Tours model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(?int $id = null)
    {
        $model = new Tours();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(Url::to(['tours/index', 'id' => $model->game_id]));
            } else {
               // var_dump($model->getErrors()); die();
            }
        } else {
            $model->loadDefaultValues();
        }

        $gameId = $id ?: $model->game_id;

        $game = Games::getGameById($gameId);

        return $this->render('create', [
            'model' => $model,
            'id' => $gameId,
            'game' => $game,
        ]);
    }

    /**
     * Updates an existing Tours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['tours/index', 'id' => $model->game_id]));
        }

        $game = Games::getGameById($model->game_id);
        return $this->render('update', [
            'model' => $model,
            'game' => $game,
        ]);
    }

    /**
     * Deletes an existing Tours model.
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
     * Finds the Tours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tours::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @throws Exception
     */
    public function actionAddImage()
    {
        $response['success'] = false;

        $response['msg'] = $this->checkFile($_POST, $_FILES);

        if ($response['msg'] != '') {
            return json_encode($response);
        }

        if (empty($_FILES['file']['type']) or $_FILES['file']['type'] != 'image/jpeg') {
            $response['msg'] = 'Неверный формат файла. Загрузите jpg файл';
            return json_encode($response);
        }

        if ($_FILES['file']['size'] > UploadFileHelper::MAX_UPLOAD_IMAGE_SIZE) {
            $response['msg'] = 'Размер файла не должен превышать 5 МБ';
            return json_encode($response);
        }

        $image = new TourAttachments();
        $image->tour_id = $_POST['id'];

        if ($image->addImage($_FILES['file']['tmp_name'])) {
            $response['success'] = true;
        } else {
            $response['msg'] = 'Ошибка загрузки файла';
        }

        return json_encode($response);
    }

    /**
     * @return false|string
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDeleteImage()
    {
        $response['msg'] = '';
        $response['success'] = false;

        if (empty($_POST['id'])) {
            $response['msg'] = 'Ошибка удаления файла';
        }

        $model = $this->getFileModel($_POST['id']);

        if (!$model) {
            $response['msg'] = 'Ошибка удаления файла';
            return json_encode($response);
        }

        if ($model->deleteFile()) {
            $response['success'] = true;
        } else {
            $response['msg'] = 'Ошибка удаления файла';
        }

        return json_encode($response);
    }

    protected function getFileModel($id)
    {
        return TourAttachments::findOne(['id' => $id]);
    }

    private function checkFile($post, $files): string
    {
        $errMsg = '';

        if (empty($post['id'])) {
            $errMsg = 'Ошибка загрузки файла';
        }

        if (empty($files['file'])) {
            $errMsg = 'Ошибка загрузки файла';
        }

        if (empty($files['file']['name'])) {
            $errMsg = 'Ошибка загрузки файла';
        }

        return $errMsg;
    }

}
