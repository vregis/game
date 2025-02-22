<p>Тур <?php echo $tour->id?> завершен</p>
<p>Результаты</p>
<?php if ($stat):?>
    <table class="table">
        <thead>
            <th>Номер вопроса</th>
            <th>Текст вопроса</th>
            <th>Ваш Ответ</th>
            <th>Верный ответ</th>
            <th>Результат</th>
        </thead>
        <?php $pts = 0;?>
    <?php foreach ($stat as $s):?>
        <tr>
            <td><?php echo $s->number?></td>
            <td><?php echo $s->text?></td>
            <td><?php echo $s->answer?></td>
            <td>
                <?php if ($answers = \common\models\Answers::getAnswersByQuestionId($s->qId)):?>
                    <?php echo $answers[0]->text;?>
                    <?php unset($answers[0])?>
                    <?php $i = 0;?>
                    (
                    <?php foreach ($answers as $answer):?>
                        <?php echo $answer->text?>,&nbsp
                    <?php endforeach;?>
                    )
                <?php endif;?>
            </td>
            <td>
                <?php if ($s->is_correct):?>
                    <?php $pts++;?>
                    <span style="color:green">Верно</span>
                <?php else:?>
                    <span style="color:red">Неверно</span>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
    </table>
    <p><b>НАБРАНО: <?php echo $pts?> очков</b></p>
<?php endif;?>

<button class="btn btn-success next-tour" data-id = '<?php echo $tour->number?>' data-url="<?php echo \yii\helpers\Url::to(['/site/next-tour'])?>">К следующему туру</button>

<?php
$this->registerJs("
    
    $('.next-tour').click(function(){
        
        $.ajax({
                type: 'POST',
                data:{id: $(this).attr('data-id')},
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

