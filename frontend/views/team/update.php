<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Team $model */

$this->title = 'Редактировать команду: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="team-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
