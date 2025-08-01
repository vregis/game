<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Prompts $model */

$this->title = 'Update Prompts: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Подсказки', 'url' => ['index', 'id' => $model->question_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prompts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
