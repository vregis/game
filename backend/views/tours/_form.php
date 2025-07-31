<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tours $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tours-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['type' => 'number']) ?>

    <?php if ($game->question_type != 2):?>
        <?= $form->field($model, 'time')->textInput(['type' => 'number']) ?>
    <?php endif;?>

    <?= $form->field($model, 'game_id')->hiddenInput(['value' => $id])->label(false) ?>

    <!--<?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'is_perforate')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <?= $form->field($model, 'bonus')->textInput(['type' => 'number']) ?>

    <?php
    echo $form->field($model, 'text')
        ->widget(
            \Itstructure\CKEditor\CKEditor::className(),
            [
                'preset' => 'custom',
                'clientOptions' => [
                    'toolbarGroups' => [
                        [
                            'name' => 'undo'
                        ],
                        [
                            'name' => 'basicstyles',
                            'groups' => ['basicstyles', 'cleanup']
                        ],
                        [
                            'name' => 'colors'
                        ],
                        [
                            'name' => 'links',
                            'groups' => ['links', 'insert']
                        ],
                        [
                            'name' => 'others',
                            'groups' => ['others', 'about']
                        ],
                    ],
                    'filebrowserBrowseUrl' => '/ckfinder/ckfinder.html',
                    'filebrowserImageBrowseUrl' => '/ckfinder/ckfinder.html?type=Images',
                    'filebrowserUploadUrl' => '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    'filebrowserImageUploadUrl' => '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    'filebrowserWindowWidth' => '1000',
                    'filebrowserWindowHeight' => '700',
                    'allowedContent' => true,
                    'language' => 'en',
                ]
            ]
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
