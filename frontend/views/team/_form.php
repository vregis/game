<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Team $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="team-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'creator_id')->textInput() ?> -->

    <?= $form->field($model, 'captain_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?> -->





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<hr/>
<?php if (!$model->isNewRecord): ?>
<div id="accordion">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Приглашения
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class="form-group">
                    <label for="invite-user">Выберите игрока</label>
                    <select class="form-control" id="invite-user" data-team-id="<?php echo $model->id?>" data-url="<?php echo \yii\helpers\Url::to(['/team/add-invite'])?>">
                        <?php foreach (\common\models\Team::getAvailableUsers() as $user):?>
                            <option value="<?php echo $user->id?>"><?php echo $user->username?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success add-invite">Пригласить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Список игроков
                </button>
            </h5>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <th>№</th>
                    <th>Название</th>
                    <th>Действия</th>
                    </thead>
                    <?php $players = \common\models\Team::getPlayersByTeamId($model->id);?>
                    <?php if (!$players):?>
                        <tr>
                            <td colspan="3">Игроков нет</td>
                        </tr>
                    <?php else:?>
                        <?php $i = 1;?>
                        <?php foreach ($players as $player):?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $player->uName;?></td>
                                <td><button class="btn btn-danger">Удалить игрока</button></td>
                            </tr>
                        <?php $i++;?>
                        <?php endforeach;?>
                    <?php endif;?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<?php
$this->registerJs("
    
    $('.add-invite').click(function(e){
        e.preventDefault();
        user = $('#invite-user').val();
        team = $('#invite-user').attr('data-team-id');
        $.ajax({
			type: 'POST',
			url: $('#invite-user').attr('data-url'),
			data: {id: user, team_id: team},
			dataType : 'json',
			success: function(msg){
				alert(msg.message)
            }
        });
        
    })
    
 ")
?>
