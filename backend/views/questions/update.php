<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Questions $model */

$this->title = 'Update Questions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index', 'id' => $model->tour_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="questions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $model->tour_id
    ]) ?>

</div>
