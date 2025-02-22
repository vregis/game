<?php

use common\models\Questions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Questions', Url::to(['create', 'id' => $id]), ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'text',
            'tour_id',
            'number',
          //  'created_at',
            //'updated_at',
            //'time:datetime',
            [
                'class' => ActionColumn::className(),
                'template' => '{prompts} {view} {update} {delete}',
                'urlCreator' => function ($action, Questions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'buttons' => [
                        'prompts' => function ($url, $model, $key) {
                            return Html::a('&#9997;', Url::to(['/prompts/index', 'id' => $model->id]), ['title' => 'Подсказки']);
                        }
                ],
            ],
        ],
    ]); ?>


</div>
