<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Games $model */

$this->title = 'Create Games';
$this->params['breadcrumbs'][] = ['label' => 'Игры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
