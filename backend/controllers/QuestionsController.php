<?php

namespace backend\controllers;

use common\models\Answers;
use common\models\helpers\UploadFileHelper;
use common\models\Questions;
use common\models\QuestionsAttachments;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Questions model.
 */
class QuestionsController extends BackendController
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
     * Lists all Questions models.
     *
     * @return string
     */
    public function actionIndex(?int $id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Questions::find()->where(['tour_id' => $id]),
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
     * Displays a single Questions model.
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
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(?int $id = null)
    {
        $model = new Questions();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $this->redirect(Url::to(['questions/update', 'id' => $model->id]));
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'id' => $id ?: $model->tour_id,
        ]);
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['questions/index', 'id' => $model->tour_id]));
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Questions model.
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
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questions::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getFileModel($id): ?QuestionsAttachments
    {
        return QuestionsAttachments::findOne(['id' => $id]);
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

        $image = new QuestionsAttachments();
        $image->question_id = $_POST['id'];

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

        $audio = new QuestionsAttachments();
        $audio->question_id = $_POST['id'];

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

        $video = new QuestionsAttachments();
        $video->question_id = $_POST['id'];

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

    public function actionAddAnswer()
    {
        $response['success'] = false;

        if (empty($_POST['id']) || empty($_POST['answer'])) {
            $response['msg'] = 'Произошла ошибка';
            return json_encode($response);
        }

        $answer = new Answers();
        $answer->question_id = $_POST['id'];
        $answer->text = $_POST['answer'];

        if ($answer->save()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['msg'] = 'Произошла ошибка';
        }

        return json_encode($response);
    }

    public function actionDeleteAnswer()
    {
        $response['success'] = false;
        if (empty($_POST['id'])) {
            $response['msg'] = 'Произошла ошибка';
            return json_encode($response);
        }

        $answer = Answers::findOne($_POST['id']);

        if (!$answer) {
            $response['msg'] = 'Произошла ошибка';
            return json_encode($response);
        }

        if ($answer->delete()) {
            $response['success'] = true;
        } else {
            $response['msg'] = 'Произошла ошибка';
        }

        return json_encode($response);
    }


}
