<?php if (!$games):?>
    <li>В данном городе игр не обнаружено</li>
<?php else: ?>
<?php foreach ($games as $game):?>
        <li><a style="text-decoration: none; color:#2563eb" href="<?php echo \yii\helpers\Url::to(['/site/game-detail', 'id' => $game->id])?>"><?php echo $game->name?></a></li>
<?php endforeach;?>
<?php endif;?>
