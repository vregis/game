<?php if ($allStat):?>
<?php $count = 0;?>
    <table class="table">
        <thead>
        <th>Ответ</th>
        <th>Результат</th>
        <th>Время</th>
        </thead>
    <?php foreach ($allStat as $stat):?>
        <tr>
            <td><?php echo $stat->answer?></td>
            <td>
                <?php if ($stat->is_correct == 1):?>
                    <span style="color:green">Верно</span>
                    <?php $count++?>
                <?php elseif($stat->is_correct == 2):?>
                    <span style="color:brown">Дубль</span>
                <?php else:?>
                    <span style="color:red">Неверно</span>
                <?php endif;?>
            </td>
            <td><?php echo $stat->created_at?></td>
        </tr>
    <?php endforeach;?>
    </table>

    <h1>Всего правильных ответов: <?php echo $count?></h1>
<?php endif;?>

<div>
    <?php if ($nextTour):?>
        <a class="btn btn-success"  href="<?php echo \yii\helpers\Url::to(['/quest/new-tour', 'id' => $nextTour->id])?>">К следующему туру</a>
    <?php else:?>
        <a class="btn btn-success" href="<?php echo \yii\helpers\Url::to(['/quest/game-stat'])?>">К игровой статистике</a>
    <?php endif;?>
</div>

<?php
$this->registerJs("
    
    $('.next-tour11').click(function(){
        
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
