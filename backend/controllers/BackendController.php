<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class BackendController extends Controller
{
    public function init()
    {
        parent::init();
        if (!\Yii::$app->user->can('viewAdminPage')) {
            throw new ForbiddenHttpException('Access denied');
        }
    }
}