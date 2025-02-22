<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tours $model */

$this->title = 'Create Tours';
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
        'game' => $game,
    ]) ?>

</div>
