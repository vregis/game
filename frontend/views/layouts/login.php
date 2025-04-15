<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);

$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        /* Основные цвета Pip-Boy */
        :root {
            --pipboy-primary: #14fe17; /* Зеленый цвет дисплея Pip-Boy */
            --pipboy-dark: #0a280a; /* Темно-зеленый фон */
            --pipboy-light: #1eff21; /* Светло-зеленый для акцентов */
            --pipboy-text: #14fe17; /* Основной текст */
            --pipboy-shadow: rgba(20, 254, 23, 0.5); /* Тень в стиле Pip-Boy */
        }

        /* Общие стили */
        body {
            background-color: var(--pipboy-dark);
            color: var(--pipboy-text);
            font-family: 'Courier New', monospace;
            text-shadow: 0 0 5px var(--pipboy-shadow);
            line-height: 1.4;
        }

        /* Типография */
        h1, h2, h3, h4, h5, h6 {
            color: var(--pipboy-light);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Кнопки */
        .btn {
            border-radius: 0;
            border: 1px solid var(--pipboy-primary);
            background-color: transparent;
            color: var(--pipboy-primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: var(--pipboy-primary);
            color: var(--pipboy-dark);
            box-shadow: 0 0 10px var(--pipboy-shadow);
        }

        .btn-primary {
            background-color: var(--pipboy-primary);
            color: var(--pipboy-dark);
        }

        .btn-primary:hover {
            background-color: var(--pipboy-light);
            border-color: var(--pipboy-light);
        }

        /* Формы */
        .form-control {
            background-color: rgba(10, 40, 10, 0.8);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
            color: var(--pipboy-text);
        }

        .form-control:focus {
            background-color: rgba(10, 40, 10, 0.9);
            color: var(--pipboy-light);
            border-color: var(--pipboy-light);
            box-shadow: 0 0 10px var(--pipboy-shadow);
        }

        /* Навигация */
        .navbar {
            background-color: var(--pipboy-dark);
            border-bottom: 1px solid var(--pipboy-primary);
        }

        .nav-link {
            color: var(--pipboy-text);
            text-transform: uppercase;
        }

        .nav-link:hover {
            color: var(--pipboy-light);
            text-shadow: 0 0 5px var(--pipboy-shadow);
        }

        /* Карточки */
        .card {
            background-color: rgba(10, 40, 10, 0.5);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
            color: var(--pipboy-text);
        }

        .card-header {
            background-color: rgba(20, 254, 23, 0.1);
            border-bottom: 1px solid var(--pipboy-primary);
        }

        /* Таблицы */
        .table {
            color: var(--pipboy-text);
            border-color: var(--pipboy-primary);
        }

        .table th {
            border-color: var(--pipboy-primary);
        }

        .table td {
            border-color: var(--pipboy-primary);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(20, 254, 23, 0.1);
            color: var(--pipboy-light);
        }

        /* Прогресс-бары */
        .progress {
            background-color: rgba(10, 40, 10, 0.8);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
        }

        .progress-bar {
            background-color: var(--pipboy-primary);
        }

        /* Модальные окна */
        .modal-content {
            background-color: var(--pipboy-dark);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
        }

        .modal-header, .modal-footer {
            border-color: var(--pipboy-primary);
        }

        /* Списки */
        .list-group-item {
            background-color: rgba(10, 40, 10, 0.5);
            border: 1px solid var(--pipboy-primary);
            color: var(--pipboy-text);
        }

        .list-group-item-action:hover {
            background-color: rgba(20, 254, 23, 0.2);
            color: var(--pipboy-light);
        }

        /* Дополнительные эффекты для аутентичности */
        .pipboy-scanline {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                    rgba(20, 254, 23, 0) 50%,
                    rgba(20, 254, 23, 0.05) 50%
            );
            background-size: 100% 4px;
            pointer-events: none;
            z-index: 9999;
            animation: scanline 8s linear infinite;
        }

        @keyframes scanline {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 0 100%;
            }
        }

        /* Эффект статики для фона */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                    radial-gradient(circle at center, transparent 0%, var(--pipboy-dark) 100%),
                    repeating-linear-gradient(
                            0deg,
                            rgba(20, 254, 23, 0.1),
                            rgba(20, 254, 23, 0.1) 1px,
                            transparent 1px,
                            transparent 2px
                    );
            opacity: 0.2;
            pointer-events: none;
            z-index: -1;
        }

        .content-wrapper {
            background-color: inherit;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
</div>

<?php $this->endBody() ?>
<div class="pipboy-scanline"></div>
</body>
</html>
<?php $this->endPage() ?>
