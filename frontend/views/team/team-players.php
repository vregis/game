<h1><?php echo $team->name?></h1>
<h2>Состав:</h2>

<?php if (!$players):?>
    <p>В данной команде нет игроков</p>
<?php else:?>
    <ol>
        <?php foreach ($players as $player):?>
            <li><?php echo $player->uName?></li>
        <?php endforeach;?>
    </ol>
<?php endif;?>