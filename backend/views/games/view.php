<?php

use backend\helpers\Constants;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Games $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="games-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'=> 'game_type',
                'value' => function($model){
                    return Constants::$gameTypes[$model->game_type];
                }
            ],
            [
                'attribute'=> 'question_type',
                'value' => function($model){
                    return Constants::$gameQuestionTypes[$model->question_type];
                }
            ],
          //  'is_paid',
          //  'price',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
