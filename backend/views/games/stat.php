<?php
if (!$games) {
    echo 'Статистика по данной игре отсутствует';
}
?>
<table>
    <thead>
    <th>Пользователь</th>
    <th>Время</th>
    </thead>
<?php
foreach ($games as $game):
    $user = \common\models\User::find()->where(['id' => $game->user_id])->one();
    if (!$user) {
        continue;
    }
?>
    <tr>
        <td><?php echo $user->username?></td>
        <td><?php echo \common\models\Games::dateDifference($game->start_at, $game->end_at, 'string')?></td>
    </tr>
<?php endforeach; ?>
</table>