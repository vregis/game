<?php if (!$games):?>
    <li>В данном городе игр не обнаружено</li>
<?php else: ?>
<?php foreach ($games as $game):?>
    <li><?php echo $game->name?></li>
<?php endforeach;?>
<?php endif;?>
