<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Prompts $model */

$this->title = 'Create Prompts';
$this->params['breadcrumbs'][] = ['label' => 'Prompts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prompts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
