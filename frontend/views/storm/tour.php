<style>
    :root {
        --bs-refresh-primary: #4361ee;
        --bs-refresh-secondary: #6c757d;
        --bs-refresh-success: #06d6a0;
        --bs-refresh-info: #118ab2;
        --bs-refresh-warning: #ffd166;
        --bs-refresh-danger: #ef476f;
        --bs-refresh-light: #f8f9fa;
        --bs-refresh-dark: #212529;
        --bs-refresh-border-radius: 12px;
        --bs-refresh-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --bs-refresh-transition: all 0.3s ease;
    }

    /* Обновленные кнопки */
    .btn {
        border-radius: var(--bs-refresh-border-radius);
        transition: var(--bs-refresh-transition);
        font-weight: 500;
        padding: 0.5rem 1.5rem;
        border: none;
    }

    .btn-primary {
        background-color: var(--bs-refresh-primary);
    }

    .btn-primary:hover {
        background-color: #3a56d4;
        transform: translateY(-2px);
        box-shadow: var(--bs-refresh-box-shadow);
    }

    .btn-success {
        background-color: var(--bs-refresh-success);
    }

    .btn-info {
        background-color: var(--bs-refresh-info);
    }

    .btn-warning {
        background-color: var(--bs-refresh-warning);
        color: var(--bs-refresh-dark);
    }

    .btn-danger {
        background-color: var(--bs-refresh-danger);
    }

    /* Карточки */
    .card {
        border-radius: var(--bs-refresh-border-radius);
        box-shadow: var(--bs-refresh-box-shadow);
        border: none;
        transition: var(--bs-refresh-transition);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-top-left-radius: var(--bs-refresh-border-radius) !important;
        border-top-right-radius: var(--bs-refresh-border-radius) !important;
        border-bottom: none;
        font-weight: 600;
    }

    /* Навигация */
    .navbar {
        box-shadow: var(--bs-refresh-box-shadow);
        padding: 0.8rem 1rem;
    }

    .nav-link {
        font-weight: 500;
        transition: var(--bs-refresh-transition);
        border-radius: 8px;
        padding: 0.5rem 1rem !important;
    }

    .nav-link:hover {
        background-color: rgba(67, 97, 238, 0.1);
    }

    /* Формы */
    .form-control {
        border-radius: var(--bs-refresh-border-radius);
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: var(--bs-refresh-transition);
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        border-color: var(--bs-refresh-primary);
    }

    /* Уведомления */
    .alert {
        border-radius: var(--bs-refresh-border-radius);
        border: none;
        box-shadow: var(--bs-refresh-box-shadow);
    }

    /* Модальные окна */
    .modal-content {
        border-radius: var(--bs-refresh-border-radius);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        border: none;
    }

    /* Аккордеон */
    .accordion-button {
        border-radius: var(--bs-refresh-border-radius) !important;
        font-weight: 500;
        padding: 1rem 1.25rem;
    }

    /* Утилиты */
    .rounded {
        border-radius: var(--bs-refresh-border-radius) !important;
    }

    .shadow {
        box-shadow: var(--bs-refresh-box-shadow) !important;
    }
</style>
<div class="accordion" id="accordionExample1">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-tours" aria-expanded="true" aria-controls="collapseOne">
                    Выбрать другой тур
                </button>
            </h2>
        </div>

        <div id="collapse-tours" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <?php foreach ($tours as $t):?>
                <?php $isDisabled = in_array($t->id, $disabledTours)?>
                    <p><a <?php echo $isDisabled? "onclick= 'return false'" : ""?> href="<?php echo \yii\helpers\Url::to(['/storm/tour', 'id' => $t->id])?>"><?php echo $t->name?> <?php echo $isDisabled ?'(Тур закрыт)':''?></a></p>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<div class="col-12"><h3>Осталось: <span class="rem-time"></span> секунд</h3></div>
<div class="update-stat"  data-url="<?php echo \yii\helpers\Url::to(['/storm/update-stat'])?>" data-end-url="<?php echo \yii\helpers\Url::to(['/storm/game-end'])?>" data-tour-url="<?php echo \yii\helpers\Url::to(['/storm/tour'])?>" data-prompt-url="<?php echo \yii\helpers\Url::to(['/storm/prompts'])?>"></div>
<div style="margin-bottom:20px;" class="container-fluid">
    <div class="row">
        <div style="margin-bottom:10px" class="col-lg-4 col-md-12 col-sm-12">
            <input class="form-control answer" type="text">
        </div>
        <div style="margin-bottom:10px" class="col-lg-2 col-md-12 col-sm-12">
            <button class="btn btn-success col-lg-12 col-md-12 col-sm-12 send-answer" data-url="<?php echo \yii\helpers\Url::to(['/storm/send-answer'])?>" data-tour-id="<?php echo $tour->id?>">Ответ</button>
        </div>
        <div style="margin-bottom:10px" class="col-lg-4 col-md-12 col-sm-12">
            <div style="color:green; display:none; margin-top:4px" class="correct-answer">Верно</div>
            <div style="color:red; margin-top:4px; display: none" class="incorrect-answer">Неверно</div>
        </div>
    </div>
</div>
<h1><?php echo $tour->name?></h1>
<?php if (isset($tour->text)):?>
    <p><?php echo $tour->text?></p>
<?php endif;?>

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
                        <?php $prompts = \common\models\Prompts::find()->where(['question_id' => $q->id])->all(); ?>
                        <?php if ($prompts):?>
                            <?php foreach ($prompts as $p):?>
                                <div style="margin-top:20px; font-size:12px" class="prompts">
                                    Подсказка: <span class="time-prompt-<?php echo $p->id?>"></span><span style="display: none" class="prompt-<?php echo $p->id?>"><?php echo $p->text?></span>
                                </div>
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
                    if (msg.switchTour != 0 && msg.switchTour != undefined) {
                        window.location.href = $('.update-stat').attr('data-tour-url') + '?id=' + msg.switchTour;
                    }
                }
                       
        })
        
        $.ajax({
                type: 'POST',
                data:{tour_id: $('.send-answer').attr('data-tour-id')},
                url: $('.update-stat').attr('data-prompt-url'),
                dataType: 'json',
                success: function(msg){
                    for (key in msg.prompts) {
                        if (msg.prompts[key]['time'] == 0) {
                            $('.prompt-' + key).show();
                            $('.time-prompt-' + key).hide();
                        } else {
                        $('.prompt-' + key).hide();
                        $('.time-prompt-' + key).html(msg.prompts[key]['time']);
                        $('.time-prompt-' + key).show();
                        }
                    }
                }
                       
        })
    }
    
")
?>
