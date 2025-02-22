<?php

namespace common\models;

use common\models\generated\Questions;
use common\models\helpers\UploadFileHelper;
use Throwable;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Expression;
use yii\db\StaleObjectException;

class QuestionsAttachments extends generated\QuestionsAttachments
{

    public function behaviors() :array
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

    public function rules()
    {
        return [
            [['question_id', 'type'], 'integer'],
            [['url'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::class, 'targetAttribute' => ['question_id' => 'id']],
        ];
    }



    /**
     * @throws Exception
     */
    public function addImage(string $fileName): bool
    {
        $dir = 'questions';
        $entity = UploadFileHelper::ATTACHMENT_IMAGE;
        $fileNameInServer = time() . '.jpg';

        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
    }

    public function addAudio(string $fileName): bool
    {
        $dir = 'questions';
        $entity = UploadFileHelper::ATTACHMENT_AUDIO;
        $fileNameInServer = time() . '.mp3';

        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
    }

    public function uploadFile($dir, $entity, $fileNameInServer, $fileName): bool
    {
        UploadFileHelper::createFolderIfNotExist($dir, $entity, $this->question_id);
        $url = $_SERVER['DOCUMENT_ROOT'] . UploadFileHelper::UPLOAD_DIR .$dir.'/'.$entity.'/'.$this->question_id.'/' . $fileNameInServer;

        if (move_uploaded_file($fileName, $url)) {
            $this->url = $fileNameInServer;
            $typeArray = UploadFileHelper::getAttachmentsTypes();
            $this->type = $typeArray[$entity];

            if (!$this->save()) {
                unlink($url);
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $questionId
     * @param $type
     * @return array|ActiveRecord[]
     */
    public static function getAttachments($questionId, $type): array
    {
        return self::find()->where(['question_id' => $questionId, 'type' => $type])->all();
    }

    /**
     * @return int
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function deleteFile(): int
    {
        $dir = array_search($this->type, UploadFileHelper::getAttachmentsTypes());

        if (!isset($dir)) {
            return 0;
        }

        $url = $_SERVER['DOCUMENT_ROOT'] . UploadFileHelper::UPLOAD_DIR . '/questions/' . $dir.'/'.$this->question_id.'/'.$this->url;

        if (!file_exists($url)) {
            return 0;
        }

        if (unlink($url)) {
            if ($this->delete()) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function addVideo(string $fileName): bool
    {
        $dir = 'questions';
        $entity = UploadFileHelper::ATTACHMENT_VIDEO;
        $fileNameInServer = time() . '.mp4';

        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
    }

}