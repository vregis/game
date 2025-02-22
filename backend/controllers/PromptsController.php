<?php

namespace backend\controllers;

use common\models\helpers\UploadFileHelper;
use common\models\Prompts;
use common\models\PromptsAttachments;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PromptsController implements the CRUD actions for Prompts model.
 */
class PromptsController extends BackendController
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
     * Lists all Prompts models.
     *
     * @return string
     */
    public function actionIndex(?int $id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Prompts::find()->where(['question_id' => $id]),
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
     * Displays a single Prompts model.
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
     * Creates a new Prompts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(?int $id = null)
    {
        $model = new Prompts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
            'id' => $id ?: $model->question_id,
        ]);
    }

    /**
     * Updates an existing Prompts model.
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
     * Deletes an existing Prompts model.
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
     * Finds the Prompts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Prompts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prompts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getFileModel($id): ?PromptsAttachments
    {
        return PromptsAttachments::findOne(['id' => $id]);
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

        $image = new PromptsAttachments();
        $image->prompt_id = $_POST['id'];

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

    public function actionAddAudio()
    {
        $response['success'] = false;
        $response['msg'] = $this->checkFile($_POST, $_FILES);

        if ($response['msg'] != '') {
            return json_encode($response);
        }

        if (empty($_FILES['file']['type']) or $_FILES['file']['type'] != 'audio/mpeg') {
            $response['msg'] = 'Неверный формат файла. Загрузите mp3 файл';
            return json_encode($response);
        }

        if ($_FILES['file']['size'] > UploadFileHelper::MAX_UPLOAD_AUDIO_SIZE) {
            $response['msg'] = 'Размер файла не должен превышать 9 МБ';
            return json_encode($response);
        }

        $audio = new PromptsAttachments();
        $audio->prompt_id = $_POST['id'];

        if ($audio->addAudio($_FILES['file']['tmp_name'])) {
            $response['success'] = true;
        } else {
            $response['msg'] = 'Ошибка загрузки файла';
        }

        return json_encode($response);

    }

    public function actionAddVideo()
    {
        $response['success'] = false;
        $response['msg'] = $this->checkFile($_POST, $_FILES);

        if ($response['msg'] != '') {
            return json_encode($response);
        }

        if (empty($_FILES['file']['type']) or $_FILES['file']['type'] != 'video/mp4') {
            $response['msg'] = 'Неверный формат файла. Загрузите mp4 файл';
            return json_encode($response);
        }

        if ($_FILES['file']['size'] > UploadFileHelper::MAX_UPLOAD_VIDEO_SIZE) {
            $response['msg'] = 'Размер файла не должен превышать 20 МБ';
            return json_encode($response);
        }

        $video = new PromptsAttachments();
        $video->prompt_id = $_POST['id'];

        if ($video->addVideo($_FILES['file']['tmp_name'])) {
            $response['success'] = true;
        } else {
            $response['msg'] = 'Ошибка загрузки файла';
        }

        return json_encode($response);
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
