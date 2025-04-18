<h1>Тур №<?php echo $tour->number?></h1>
<div style="margin-bottom:20px;" class="container-fluid">
    <div class="row">
        <div style="margin-bottom:10px" class="col-lg-2 col-md-12 col-sm-12">
            <a style="display:none" onclick="return confirm('Вы точно хотите пропустить тур?')" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 end-tour" href="<?php echo \yii\helpers\Url::to(['/quest/end-tour', 'id' => $tour->id])?>" data-tour-id="<?php echo $tour->id?>">Пропустить тур</a>
        </div>
    </div>
</div>
<div class="col-12"><h3>Осталось: <span class="rem-time"></span> секунд</h3></div>
<div class="update-stat" data-end-url="<?php echo \yii\helpers\Url::to(['/quest/end-tour', 'id' => $tour->id])?>" data-url="<?php echo \yii\helpers\Url::to(['/quest/update-stat'])?>"></div>
<div style="margin-bottom:20px;" class="container-fluid">
    <div class="row">
        <div style="margin-bottom:10px" class="col-lg-4 col-md-12 col-sm-12">
            <input class="form-control answer" type="text">
        </div>
        <div style="margin-bottom:10px" class="col-lg-2 col-md-12 col-sm-12">
            <button class="btn btn-success col-lg-12 col-md-12 col-sm-12 send-answer" data-url="<?php echo \yii\helpers\Url::to(['/quest/send-answer'])?>" data-tour-id="<?php echo $tour->id?>">Ответ</button>
        </div>
        <div style="margin-bottom:10px" class="col-lg-4 col-md-12 col-sm-12">
            <div style="color:green; display:none; margin-top:4px" class="correct-answer">Верно</div>
            <div style="color:red; margin-top:4px; display: none" class="incorrect-answer">Неверно</div>
        </div>
    </div>
</div>
<div class="container-fluid">
<?php foreach ($questions as $q):?>
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $q->id?>" aria-expanded="true" aria-controls="collapseOne">
                    Вопрос <?php echo $q->number?>
                    <div class="correct-answer-id-<?php echo $q->id?>" style="color:green; display: none; float:right">Верный ответ: <span class="span-answer"></span></div>
                </button>
            </h2>
        </div>

        <div id="collapse<?php echo $q->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <?php echo $q->text?>
                <?php if ($attachments = $q->questionsAttachments):?>
                    <?php foreach ($attachments as $a):?>
                        <?php if ($a->type === \common\models\helpers\UploadFileHelper::ATTACHMENT_IMAGE_ID):?>
                            <div class="attachments">
                                <img class="img-fluid" height="100" src="/uploads/questions/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_IMAGE?>/<?=$q->id?>/<?=$a->url?>">
                            </div>
                        <?php elseif ($a->type === \common\models\helpers\UploadFileHelper::ATTACHMENT_AUDIO_ID):?>
                            <div class="attachments">
                                <audio controls>
                                    <source src="/uploads/questions/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_AUDIO?>/<?=$q->id?>/<?=$a->url?>" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        <?php elseif ($a->type === \common\models\helpers\UploadFileHelper::ATTACHMENT_VIDEO_ID):?>
                            <div class="attachments">
                                <video width="320" height="240" controls>
                                    <source src="/uploads/questions/<?=\common\models\helpers\UploadFileHelper::ATTACHMENT_VIDEO?>/<?=$q->id?>/<?=$a->url?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
</div>


<?php
$this->registerJs("
    
    $('.send-answer').click(function(){
        
        $.ajax({
                type: 'POST',
                data:{answer: $('.answer').val(), tour_id: $(this).attr('data-tour-id')},
                url: $(this).attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    $('.correct-answer').hide();
                    $('.incorrect-answer').hide();
                    if (msg.success == false ) {
                        alert('Произошла ошибка');    
                    } else {
                        if (msg.is_correct == true) {
                            $('.correct-answer').show();
                            $('.answer').val('')
                        } else {
                            $('.incorrect-answer').show();
                            $('.answer').val('')
                        }
                    }
                }    
            })
    })
    
    setInterval(updateStat, 1000);

    function updateStat(){
        $.ajax({
                type: 'POST',
                data:{tour_id: $('.send-answer').attr('data-tour-id')},
                url: $('.update-stat').attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.isEnd == 1) {
                        window.location.href = $('.update-stat').attr('data-end-url');
                    }
                    $('.rem-time').html(msg.time);
                    for (key in msg.questions) {
                        $('.correct-answer-id-'+key).find('span').text(msg.questions[key]);
                        $('.correct-answer-id-'+key).show();
                    }
                }
                       
        })
    }
    
")
?>
