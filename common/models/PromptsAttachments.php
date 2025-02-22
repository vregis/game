<?php

namespace common\models;

use common\models\helpers\UploadFileHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Expression;
use yii\db\StaleObjectException;

class PromptsAttachments extends generated\PromptsAttachments
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

    /**
     * @throws Exception
     */
    public function addImage(string $fileName): bool
    {
        $dir = 'prompts';
        $entity = UploadFileHelper::ATTACHMENT_IMAGE;
        $fileNameInServer = time() . '.jpg';

        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
    }

    public function addAudio(string $fileName): bool
    {
        $dir = 'prompts';
        $entity = UploadFileHelper::ATTACHMENT_AUDIO;
        $fileNameInServer = time() . '.mp3';

        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
    }

    public function uploadFile($dir, $entity, $fileNameInServer, $fileName): bool
    {
        UploadFileHelper::createFolderIfNotExist($dir, $entity, $this->prompt_id);
        $url = $_SERVER['DOCUMENT_ROOT'] . UploadFileHelper::UPLOAD_DIR .$dir.'/'.$entity.'/'.$this->prompt_id.'/' . $fileNameInServer;

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
     * @param $promptId
     * @param $type
     * @return array|ActiveRecord[]
     */
    public static function getAttachments($promptId, $type): array
    {
        return self::find()->where(['prompt_id' => $promptId, 'type' => $type])->all();
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

        $url = $_SERVER['DOCUMENT_ROOT'] . UploadFileHelper::UPLOAD_DIR . '/prompts/' . $dir.'/'.$this->prompt_id.'/'.$this->url;

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
        $dir = 'prompts';
        $entity = UploadFileHelper::ATTACHMENT_VIDEO;
        $fileNameInServer = time() . '.mp4';

        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
    }
}