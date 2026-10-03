<?php

namespace common\models;

use common\models\helpers\UploadFileHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Expression;
use yii\db\StaleObjectException;

class TourAttachments extends generated\TourAttachments
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
            [['tour_id', 'type'], 'integer'],
            [['url'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tours::class, 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }



    /**
     * @throws Exception
     */
    public function addImage(string $fileName): bool
    {
        $dir = 'tour';
        $entity = UploadFileHelper::ATTACHMENT_IMAGE;
        $fileNameInServer = time() . '.jpg';

        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
    }

//    public function addAudio(string $fileName): bool
//    {
//        $dir = 'tour';
//        $entity = UploadFileHelper::ATTACHMENT_AUDIO;
//        $fileNameInServer = time() . '.mp3';
//
//        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
//    }

    public function uploadFile($dir, $entity, $fileNameInServer, $fileName): bool
    {
        UploadFileHelper::createFolderIfNotExist($dir, $entity, $this->tour_id);
        $url = $_SERVER['DOCUMENT_ROOT'] . UploadFileHelper::UPLOAD_DIR .$dir.'/'.$entity.'/'.$this->tour_id.'/' . $fileNameInServer;

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
     * @param $tourId
     * @param $type
     * @return array|ActiveRecord[]
     */
    public static function getAttachments($tourId, $type): array
    {
        return self::find()->where(['tour_id' => $tourId, 'type' => $type])->all();
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

        $url = $_SERVER['DOCUMENT_ROOT'] . UploadFileHelper::UPLOAD_DIR . '/tour/' . $dir.'/'.$this->tour_id.'/'.$this->url;

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

//    public function addVideo(string $fileName): bool
//    {
//        $dir = 'tour';
//        $entity = UploadFileHelper::ATTACHMENT_VIDEO;
//        $fileNameInServer = time() . '.mp4';
//
//        return $this->uploadFile($dir, $entity, $fileNameInServer, $fileName);
//    }
}