<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Prompts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="prompts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'question_id')->hiddenInput(['value' => $id])->label(false) ?>

    <?= $form->field($model, 'time')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>

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
         data-url = '<?php echo \yii\helpers\Url::to(['/prompts/add-image'])?>'
         data-id = '<?php echo $model->id?>'>
    </div>
    <div class = ''>
        <div class="row" style="margin-top:20px">
            <?php $images = \common\models\PromptsAttachments::getAttachments($model->id, \common\models\helpers\UploadFileHelper::ATTACHMENT_IMAGE_ID)?>

            <?php if ($images):?>
                <?php foreach ($images as $image):?>
                    <div class="col-sm-2">
                        <img class="img-fluid" height="100" src="/uploads/prompts/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_IMAGE?>/<?=$model->id?>/<?=$image->url?>">
                        <div class="delete-image" data-url="<?php echo \yii\helpers\Url::to(['/prompts/delete-image'])?>" data-id="<?=$image->id?>" style="text-align: center; margin-top: 5px; margin-bottom: 5px; cursor:pointer">Удалить</div>
                    </div>

                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
    <hr>
    <h2>Аудио</h2>
    <input type="file" id="audio-upload" value="Добавить аудио">
    <div class='audio-url'
         data-url = '<?php echo \yii\helpers\Url::to(['/prompts/add-audio'])?>'
         data-id = '<?php echo $model->id?>'>
    </div>
    <div class="row" style="margin-top:20px">
        <?php $audio = \common\models\PromptsAttachments::getAttachments($model->id, \common\models\helpers\UploadFileHelper::ATTACHMENT_AUDIO_ID)?>

        <?php if ($audio):?>
            <?php foreach ($audio as $a):?>
                <div>
                    <audio controls>
                        <source src="/uploads/prompts/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_AUDIO?>/<?=$model->id?>/<?=$a->url?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="delete-image" data-url="<?php echo \yii\helpers\Url::to(['/prompts/delete-image'])?>" data-id="<?=$a->id?>" style="text-align: center; margin-top: 5px; margin-bottom: 5px; cursor:pointer">Удалить</div>
                </div>


            <?php endforeach;?>
        <?php endif;?>
    </div>
    <hr>

    <h2>Видео</h2>
    <input type="file" id="video-upload" value="Добавить видео">
    <div class='video-url'
         data-url = '<?php echo \yii\helpers\Url::to(['/prompts/add-video'])?>'
         data-id = '<?php echo $model->id?>'>
    </div>
    <div class="row" style="margin-top:20px">
        <?php $video = \common\models\PromptsAttachments::getAttachments($model->id, \common\models\helpers\UploadFileHelper::ATTACHMENT_VIDEO_ID)?>

        <?php if ($video):?>
            <?php foreach ($video as $v):?>
                <div class="col-sm-12">
                    <video width="320" height="240" controls>
                        <source src="/uploads/prompts/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_VIDEO?>/<?=$model->id?>/<?=$v->url?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="delete-image" data-url="<?php echo \yii\helpers\Url::to(['/prompts/delete-image'])?>" data-id="<?=$v->id?>" style="margin-left:7%; text-align: left; margin-top: 5px; margin-bottom: 5px; cursor:pointer">Удалить</div>
                </div>

            <?php endforeach;?>
        <?php endif;?>
    </div>
    <?php
    $this->registerJs("
    $('.delete-image').click(function(){
        if (confirm('Удалить файл?')){
            $.ajax({
                type: 'POST',
                data:{id: $(this).attr('data-id')},
                url: $(this).attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true) {
                        alert('Файл успешно удален');
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
					alert('Файл успешно загружен');
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
					alert('Файл успешно загружен');
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
					alert('Файл успешно загружен');
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
