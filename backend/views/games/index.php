<?php

use backend\helpers\ActionColumnGames;
use backend\helpers\Constants;
use common\models\Games;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Constants::GAMES;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать игру', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->name, Url::to(['tours/index', 'id' => $model->id]));
                }
            ],
         /*   [
                'attribute' => 'game_type',
                'value' => function ($model) {
                    return Constants::$gameTypes[$model->game_type];
                }
            ],*/
            [
                'attribute' => 'question_type',
                'value' => function ($model) {
                    return Constants::$gameQuestionTypes[$model->question_type];
                }
            ],
            //'is_paid',
            //'price',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'template'  => '{update} {delete}',
                'urlCreator' => function ($action, Games $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
