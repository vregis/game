<?php if ($inviteList):?>
<table>
<?php foreach ($inviteList as $invite): ?>
<tr data-url="<?php echo \yii\helpers\Url::to(['/team/answer-invite'])?>" data-id="<?php echo $invite->id?>">
    <td>
        Игрок <?php echo $invite->iUsername?> приглашает вас вступить в команду <?php echo $invite->iTeamname?>
    </td>
    <td>
        <a data-answer="1" class="btn-success btn answer">Согласен</a>
    </td>
    <td>
        <a data-answer="2" class="btn-danger btn answer">Не согласен</a>
    </td>


</tr>
<?php endforeach;?>
</table>
<?php else :?>
    У вас нет новых приглашений
<?php endif;?>

<?php
$this->registerJs("
    
    $('.answer').click(function(e){
    e.preventDefault();
    if (confirm('Вы уверены?') == true) {
        status = $(this).attr('data-answer');
        id = $(this).closest('tr').attr('data-id');
        $.ajax({
			type: 'POST',
			url: $(this).closest('tr').attr('data-url'),
			data: {id: id, status: status},
			dataType : 'json',
			success: function(msg){
				alert(msg.msg)
				location.reload();
            }
        });
      } else {
        return false;
      }
        
    })
    
 ")
?>