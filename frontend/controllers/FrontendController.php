<?php

namespace frontend\controllers;

use common\models\helpers\Session;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class FrontendController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        $this->layout = 'front';
        $userId = Session::getUserId() ?? null;

        if ($userId === null) {
            throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        parent::__construct($id, $module, $config = []);
        date_default_timezone_set('Etc/GMT-3');
    }
}