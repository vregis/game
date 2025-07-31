<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Team $model */

$this->title = 'Создать команду';
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
