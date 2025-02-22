<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\UserDocuments $model */

$this->title = 'Create User Documents';
$this->params['breadcrumbs'][] = ['label' => 'User Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-documents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
