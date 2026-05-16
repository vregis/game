<?php
use yii\grid\GridView;

echo  GridView::widget([
        'dataProvider' => $games,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'userName',
                'label' => 'Пользователь',
                'format' => 'text',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'start_at',
                'label' => 'Начало игры',
                'format' => 'datetime',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'end_at',
                'label' => 'Конец игры',
                'format' => 'datetime',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'bonus',
                'label' => 'Бонус',
                'format' => 'integer',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
                [
                        'attribute' => 'duration',
                        'label' => 'Длительность',
                        'format' => 'text',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                ],

           //     ['class' => 'yii\grid\ActionColumn'],
        ],
]); ?>