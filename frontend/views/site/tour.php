<p>Добро пожаловать в тур номер '<?php echo $tour->number?>'</p>
<p><?php echo $tour->name?></p>
<button data-id = <?php echo $tour->id?> data-url="<?php echo \yii\helpers\Url::to(['/site/tour-start'])?>" class="btn btn-success tour-start">
    Начать Тур
</button>

<?php
$this->registerJs("
    
    $('.tour-start').click(function(){
        
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