<?php

/* @var $this yii\web\View */
/* @var $model common\models\FeedbackForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Обратная связь';
?>

<div class="page-header">
    <h1>Сообщить об ошибке</h1>
</div>

<?php foreach (Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php foreach ((array)$messages as $msg): ?>
        <?php
        $class = 'alert-info';
        switch ($type) {
            case 'success': $class = 'alert-success'; break;
            case 'error':
            case 'danger':  $class = 'alert-danger';  break;
            case 'warning': $class = 'alert-warning'; break;
        }
        ?>
        <div class="alert <?= $class ?>">
            <?= \yii\helpers\Html::encode($msg) ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>
<div class="card" style="max-width: 720px; margin: 0 auto;">
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'options' => ['class' => 'form'],
        ]); ?>

        <div class="form-group">
            <?= $form->field($model, 'name')
                ->textInput([
                    'class' => 'form-control',
                    'placeholder' => 'Введите имя',
                    'maxlength' => true,
                ])
                ->label('Имя') ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'message')
                ->textarea([
                    'class' => 'form-control',
                    'rows' => 6,
                    'placeholder' => 'Введите сообщение',
                ])
                ->label('Сообщение') ?>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>