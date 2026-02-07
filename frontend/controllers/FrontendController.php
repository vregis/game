<?php

namespace frontend\controllers;

use common\models\helpers\Session;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class FrontendController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config = []);
        $this->layout = 'pip';
        $userId = Session::getUserId() ?? null;

        if ($userId === null && !strstr($_SERVER['REQUEST_URI'], '/new-game?id')) {
            throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
        }

        date_default_timezone_set('Etc/GMT-3');
    }
}