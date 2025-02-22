<?php
/** @var Questions $question */
/** @var QuestionsAttachments $attachments */

use common\models\helpers\UploadFileHelper;
use common\models\Questions;
use common\models\QuestionsAttachments;

?>
<div class="container-fluid">
    <div class="row">
        <div class = 'col-12'>
            <p>Вопрос:</p>
            <p><?php echo $question->text?></p>
        </div>
    </div>
    <?php if ($attachments):?>
        <?php foreach ($attachments as $attachment):?>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <?php if ($attachment->type === UploadFileHelper::ATTACHMENT_IMAGE_ID):?>
                        <img class="img-fluid" height="100" src="/uploads/questions/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_IMAGE?>/<?=$question->id?>/<?=$attachment->url?>">
                    <?php elseif ($attachment->type === UploadFileHelper::ATTACHMENT_AUDIO_ID):?>
                        <audio controls>
                            <source src="/uploads/questions/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_AUDIO?>/<?=$question->id?>/<?=$attachment->url?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    <?php elseif ($attachment->type === UploadFileHelper::ATTACHMENT_VIDEO_ID):?>
                        <video width="320" height="240" controls>
                            <source src="/uploads/questions/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_VIDEO?>/<?=$question->id?>/<?=$attachment->url?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif;?>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <div class="row" style="padding-bottom:30px">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <input class="form-control answer-input" type="text" name="answer" placeholder="Ответ">
        </div>
    </div>
    <div class="row" style="padding-bottom:30px">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <button class="btn btn-success send-answer" data-tour-id="<?php echo $question->tour_id?>" data-id="<?php echo $question->id?>" data-url="<?php echo \yii\helpers\Url::to(['/site/next-question'])?>">Ответить</button>
        </div>
    </div>
</div>

<?php
$this->registerJs("
    
    $('.send-answer').click(function(){
        answer = $('.answer-input').val();
        
        if (answer == '') {
            if (!confirm('Отправить пустой ответ?')){
                return false;
            }
        }
        
        $.ajax({
                type: 'POST',
                data:{id: $(this).attr('data-id'), answer:answer, tour_id: $(this).attr('data-tour-id')},
                url: $(this).attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true ) {
                        window.location.href = msg.url;
                    }
                }
            })
    })
    
")
?>