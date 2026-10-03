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

    <?php //if ($game->question_type != 2):?>
        <?= $form->field($model, 'time')->textInput(['type' => 'number']) ?>
    <?php //endif;?>

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

<?php if (!$model->isNewRecord): ?>
<hr>
<h2>Картинки</h2>
<input type="file" id="image-upload" value="Добавить картинку">
<div class='image-url'
     data-url = '<?php echo \yii\helpers\Url::to(['/tours/add-image'])?>'
     data-id = '<?php echo $model->id?>'>
</div>
<div class = ''>
    <div class="row" style="margin-top:20px">
        <?php $images = \common\models\TourAttachments::getAttachments($model->id, \common\models\helpers\UploadFileHelper::ATTACHMENT_IMAGE_ID)?>

        <?php if ($images):?>
            <?php foreach ($images as $image):?>
                <div class="col-sm-2">
                    <img class="img-fluid" height="100" src="/uploads/tour/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_IMAGE?>/<?=$model->id?>/<?=$image->url?>">
                    <div class="delete-image" data-url="<?php echo \yii\helpers\Url::to(['/tours/delete-image'])?>" data-id="<?=$image->id?>" style="text-align: center; margin-top: 5px; margin-bottom: 5px; cursor:pointer">Удалить</div>
                </div>

            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
<hr>

    <?php
    $this->registerJs("
    
    $('.add-answer').click(function(){
        div = $('.append').html();
        $('.answers').append(div);
    })
    
    $('.save-answer').click(function(){
        answer = $(this).closest('div.add-answer-row').find('input.answer-input').val();
        if (answer == '') {
            alert('Введите ответ');
            return false;
        }
        $.ajax({
                type: 'POST',
                data:{id: $('.audio-url').attr('data-id'), answer: answer},
                url: $('.answers').attr('data-add-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true) {
                        location.reload();
                    } else {
                        alert(msg.msg);
                    }
                }
            })
    })
    
    $('.delete-answer').click(function(){
        if (confirm('Удалить файл?')){
        $.ajax({
                type: 'POST',
                data:{id: $(this).attr('data-id')},
                url: $('.answers').attr('data-delete-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true) {
                        location.reload();
                    } else {
                        alert(msg.msg);
                    }
                }
            })
        }    
    })
    
    $('.delete-image').click(function(){
        if (confirm('Удалить файл?')){
            $.ajax({
                type: 'POST',
                data:{id: $(this).attr('data-id')},
                url: $(this).attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true) {
                        location.reload();
                    } else {
                        alert(msg.msg);
                    }
                }
            })
        }
    })
    
$('#image-upload').change(function(e){
    var csrfToken = $('meta[name=csrf-token]').attr('content');
    e.preventDefault();
    
    if (window.FormData === undefined){
        alert('В вашем браузере FormData не поддерживается')
    } else {
        var formData = new FormData();
		formData.append('file', $('#image-upload')[0].files[0]);
		formData.append('id', $('.image-url').attr('data-id'));
		
		$.ajax({
			type: 'POST',
			url: $('.image-url').attr('data-url'),
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType : 'json',
			success: function(msg){
				if (msg.success == true) {
					location.reload();
				} else {
                    alert(msg.msg);
                }
}
});

    }
    
    
    

})

$('#audio-upload').change(function(e){
    var csrfToken = $('meta[name=csrf-token]').attr('content');
    e.preventDefault();
    
    if (window.FormData === undefined){
        alert('В вашем браузере FormData не поддерживается')
    } else {
        var formData = new FormData();
		formData.append('file', $('#audio-upload')[0].files[0]);
		formData.append('id', $('.audio-url').attr('data-id'));
		console.log($('#audio-upload')[0].files[0]);
		
		$.ajax({
			type: 'POST',
			url: $('.audio-url').attr('data-url'),
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType : 'json',
			success: function(msg){
				if (msg.success == true) {
					location.reload();
				} else {
                    alert(msg.msg);
                }
}
});
    }})
    
$('#video-upload').change(function(e){
    var csrfToken = $('meta[name=csrf-token]').attr('content');
    e.preventDefault();
    
    if (window.FormData === undefined){
        alert('В вашем браузере FormData не поддерживается')
    } else {
        var formData = new FormData();
		formData.append('file', $('#video-upload')[0].files[0]);
		formData.append('id', $('.video-url').attr('data-id'));
		
		$.ajax({
			type: 'POST',
			url: $('.video-url').attr('data-url'),
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType : 'json',
			success: function(msg){
				if (msg.success == true) {
					location.reload();
				} else {
                    alert(msg.msg);
                }
}
});
    }})    
")
    ?>


<?php endif;?>