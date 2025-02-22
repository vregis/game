<?php

use backend\helpers\Constants;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Games $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="games-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'game_type')->dropDownList(Constants::$gameTypes) ?>


    <?= $form->field($model, 'question_type')->dropDownList(Constants::$gameQuestionTypes) ?>

   <!-- <?= $form->field($model, 'is_paid')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <?php if (!$model->isNewRecord && $model->question_type === 2):?>
        <?= $form->field($model, 'time')->textInput() ?>
    <?php endif;?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить игру', ['class' => 'btn btn-success']) ?>
    </div>

    <?php if (!$model->isNewRecord):?>
        <div class="url" data-url = '<?php echo \yii\helpers\Url::to(['/games/publicate'])?>'></div>
        <?php if ($model->public === 0):?>
            <div class="form-group">
                <?= Html::submitButton(
                        'Опубликовать игру', ['class' => 'btn btn-primary publicate', 'data-id' => $model->id]
                ) ?>
            </div>
        <?php else: ?>
            <div class="form-group">
                <?= Html::submitButton(
                        'Снять игру с публикации', ['class' => 'btn btn-primary publicate', 'data-id' => $model->id]
                ) ?>
                <br/>
                <a target="_blank" href="http://<?php echo $_SERVER['HTTP_HOST']?>/frontend/web/<?php echo $model->getGameTypeFrontUrl()?>/new-game?id=<?php echo $model->url?>">http://<?php echo $_SERVER['HTTP_HOST']?>/frontend/web/<?php echo $model->getGameTypeFrontUrl()?>/new-game?id=<?php echo $model->url?></a>
            </div>
        <?php endif;?>
    <?php endif;?>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("
$('.publicate').click(function(e){
    var csrfToken = $('meta[name=csrf-token]').attr('content');
    e.preventDefault();
    
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: $('.url').attr('data-url'),
        data: {id: $(this).attr('data-id'), _csrf : csrfToken},
        success: function (data) { 
            if (data.success === false) {
                alert('Произошла ошибка, попробуйте еще раз или обратитесь к адиминистратору сайта');
            } else {
                location.reload();
            }
        }
    })
})
")
?>
