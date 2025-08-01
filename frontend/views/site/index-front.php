<?php

/** @var yii\web\View $this */

$this->title = 'Личный кабинет';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Добро пожаловать в Личный кабинет!</h1>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <?php if (Yii::$app->user->id === 15): ?>
            <h1><a href="/frontend/web/storm/new-game?id=AqGntW17253814406oVSIe">Начать игру</a></h1>
            <?php endif;?>
        </div>

    </div>
</div>
