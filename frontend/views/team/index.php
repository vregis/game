<?php

use common\models\Team;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Team', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'avatar',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Team $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <h2 style="margin-top: 50px">Ваши команды</h2>
    <table class="table team-table" data-url="<?php echo \yii\helpers\Url::to(['/team/delete-team'])?>">
        <thead>
        <th>№</th>
        <th>Команда</th>
        <th>Действия</th>
        </thead>
        <?php if (!$teams):?>
            <tr>
                <td colspan="3">Вы не состоите в команде</td>
            </tr>
        <?php else:?>
        <?php $i = 1;?>
        <?php foreach ($teams as $team):?>
        <tr>
            <td><?php echo $i?></td>
            <td><a href="<?php echo \yii\helpers\Url::to(['/team/team-players', 'id' => $team->id])?>"><?php echo $team->teamName?></a></td>
            <td><button data-team-id="<?php echo $team->id?>" class="btn btn-danger delete-team">Покинуть команду</button></td>
        </tr>
            <?php $i++;?>
        <?php endforeach;?>
        <?php endif;?>
    </table>
</div>

<?php
$this->registerJs("
    
    $('.delete-team').click(function(e){
        if (!confirm('Покинуть команду?')){
            return false;
        }
        e.preventDefault();
        id = $(this).attr('data-team-id');
        $.ajax({
			type: 'POST',
			url: $('.team-table').attr('data-url'),
			data: {id: id},
			dataType : 'json',
			success: function(msg){
				alert(msg.msg)
            }
        });
        
    })
    
 ")
?>
