<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);

$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1].'/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?//= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        /* Основные цвета - Глубоководный */
        :root {
            --pipboy-primary: #00e5ff;
            --pipboy-dark: #061a1f;
            --pipboy-light: #66f0ff;
            --pipboy-text: #00e5ff;
            --pipboy-shadow: rgba(0, 229, 255, 0.4);
        }

        body {
            background-color: var(--pipboy-dark);
            background-image:
                    radial-gradient(ellipse at 20% 80%, rgba(0, 229, 255, 0.04) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 20%, rgba(0, 229, 255, 0.02) 0%, transparent 40%);
            color: var(--pipboy-text);
            font-family: 'Courier New', monospace;
            text-shadow: 0 0 8px var(--pipboy-shadow);
            line-height: 1.4;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--pipboy-light);
            text-transform: uppercase;
            letter-spacing: 3px;
            border-bottom: 1px solid var(--pipboy-primary);
            padding-bottom: 8px;
        }

        .btn {
            border-radius: 0;
            border: 1px solid var(--pipboy-primary);
            background-color: transparent;
            color: var(--pipboy-primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s;
            position: relative;
        }

        .btn::after {
            content: " ~";
            opacity: 0.5;
        }

        .btn:hover {
            background-color: var(--pipboy-primary);
            color: var(--pipboy-dark);
            box-shadow: 0 0 25px var(--pipboy-shadow);
        }

        .btn-primary {
            background-color: var(--pipboy-primary);
            color: var(--pipboy-dark);
        }

        .btn-primary:hover {
            background-color: var(--pipboy-light);
            border-color: var(--pipboy-light);
        }

        .form-control {
            background-color: rgba(6, 26, 31, 0.8);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
            color: var(--pipboy-text);
        }

        .form-control:focus {
            background-color: rgba(6, 26, 31, 0.9);
            color: var(--pipboy-light);
            border-color: var(--pipboy-light);
            box-shadow: 0 0 20px var(--pipboy-shadow);
        }

        .navbar {
            background-color: var(--pipboy-dark);
            border-bottom: 1px solid var(--pipboy-primary);
        }

        .nav-link {
            color: var(--pipboy-text);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .nav-link:hover {
            color: var(--pipboy-light);
            text-shadow: 0 0 15px var(--pipboy-shadow);
        }

        .card {
            background-color: rgba(6, 26, 31, 0.5);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
            color: var(--pipboy-text);
        }

        .card-header {
            background-color: rgba(0, 229, 255, 0.08);
            border-bottom: 1px solid var(--pipboy-primary);
        }

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
            background-color: rgba(0, 229, 255, 0.08);
            color: var(--pipboy-light);
        }

        .progress {
            background-color: rgba(6, 26, 31, 0.8);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
            overflow: hidden;
        }

        .progress-bar {
            background-color: var(--pipboy-primary);
            background-image: linear-gradient(
                    90deg,
                    var(--pipboy-primary) 0%,
                    var(--pipboy-light) 50%,
                    var(--pipboy-primary) 100%
            );
            background-size: 200% 100%;
            animation: wave 2s linear infinite;
        }

        @keyframes wave {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .modal-content {
            background-color: var(--pipboy-dark);
            border: 1px solid var(--pipboy-primary);
            border-radius: 0;
        }

        .modal-header, .modal-footer {
            border-color: var(--pipboy-primary);
        }

        .list-group-item {
            background-color: rgba(6, 26, 31, 0.5);
            border: 1px solid var(--pipboy-primary);
            color: var(--pipboy-text);
        }

        .list-group-item-action:hover {
            background-color: rgba(0, 229, 255, 0.15);
            color: var(--pipboy-light);
        }

        .pipboy-scanline {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 3px,
                    rgba(0, 229, 255, 0.02) 3px,
                    rgba(0, 229, 255, 0.02) 4px
            );
            pointer-events: none;
            z-index: 9999;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                    radial-gradient(circle at center, transparent 30%, var(--pipboy-dark) 100%),
                    repeating-linear-gradient(
                            0deg,
                            rgba(0, 229, 255, 0.03),
                            rgba(0, 229, 255, 0.03) 1px,
                            transparent 1px,
                            transparent 2px
                    );
            opacity: 0.15;
            pointer-events: none;
            z-index: -1;
        }

        .content-wrapper {
            background-color: inherit;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('part/navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('part/sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
<div class="pipboy-scanline"></div>
</body>
</html>
<?php $this->endPage() ?>
