<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\UserDocuments $model */

$this->title = 'Update User Documents: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-documents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
