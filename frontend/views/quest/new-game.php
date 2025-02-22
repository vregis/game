<p>Добро пожаловать в игру '<?php echo $game->name?>'</p>
<button data-id = <?php echo $game->id?> data-url="<?php echo \yii\helpers\Url::to(['/quest/game-start'])?>" class="btn btn-success game-start">
    Начать игру
</button>

<?php
$this->registerJs("
    
    $('.game-start').click(function(){
        
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