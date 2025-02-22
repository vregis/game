<?php

namespace common\models\helpers;

class UploadFileHelper
{
    const UPLOAD_DIR = '/frontend/web/uploads/';

    const MAX_UPLOAD_IMAGE_SIZE = 5242880;
    const MAX_UPLOAD_AUDIO_SIZE = 9242880;
    const MAX_UPLOAD_VIDEO_SIZE = 19242880;


    const ATTACHMENT_IMAGE = 'image';
    const ATTACHMENT_AUDIO = 'audio';
    const ATTACHMENT_VIDEO = 'video';

    const ATTACHMENT_IMAGE_ID = 0;
    const ATTACHMENT_AUDIO_ID = 1;
    const ATTACHMENT_VIDEO_ID = 2;

    private static array $attachmentsTypes = [
        self::ATTACHMENT_IMAGE => self::ATTACHMENT_IMAGE_ID,
        self::ATTACHMENT_AUDIO => self::ATTACHMENT_AUDIO_ID,
        self::ATTACHMENT_VIDEO => self::ATTACHMENT_VIDEO_ID,
    ];

    public static function getAttachmentsTypes(): array
    {
        return self::$attachmentsTypes;
    }

    public static function createFolderIfNotExist($dir, $entity, $id)
    {
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR)) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR);
        }

        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR . $dir.'/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR .$dir.'/');
        }

        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR .$dir.'/'.$entity.'/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR .$dir.'/'.$entity.'/');
        }

        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR .$dir.'/'.$entity.'/'.$id.'/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR .$dir.'/'.$entity.'/'.$id.'/');
        }
    }
}