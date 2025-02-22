<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tours $model */

$this->title = 'Update Tours: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tours-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $model->game_id,
        'game' => $game,
    ]) ?>

</div>
