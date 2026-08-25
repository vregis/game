Добро пожаловать в тур номер '<?php echo $tour->number?>'</p>
<p><?php echo $tour->name?></p>
<button id="start-tour" data-id = <?php echo $tour->id?> data-url="<?php echo \yii\helpers\Url::to(['/quest/tour-start'])?>" class="btn btn-success tour-start">
    Начать Тур
</button>

<?php
$this->registerJs("

    
        
        $.ajax({
                type: 'POST',
                data:{id: $('.tour-start').attr('data-id')},
                url: $('.tour-start').attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true ) {
                        window.location.href = msg.url;
                    }
                }
            })

    
")
?>