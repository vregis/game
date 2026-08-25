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
        :root {
            --bg-primary: #ece4f0;
            --bg-secondary: #d8cce6;
            --bg-card: rgba(255, 255, 255, 0.6);
            --text-primary: #3d3547;
            --text-secondary: #6a5f77;
            --accent-primary: #c4b5d6;
            --accent-hover: #b09fc7;
            --accent-light: #e0d6e8;
            --shadow-color: rgba(180, 160, 200, 0.15);
            --border-color: rgba(180, 160, 200, 0.2);
        }

        body {
            background: linear-gradient(135deg, var(--bg-primary), var(--bg-secondary));
            color: var(--text-primary);
            font-family: 'Segoe UI', 'Arial', sans-serif;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--text-primary);
            font-weight: 300;
            letter-spacing: 0.5px;
            text-transform: none;
        }

        .btn {
            border-radius: 30px;
            border: none;
            background-color: var(--accent-primary);
            color: white;
            padding: 10px 28px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 15px;
            text-transform: none;
            letter-spacing: 0.5px;
            transition: all 0.2s;
        }

        .btn:hover {
            background-color: var(--accent-hover);
            transform: scale(1.02);
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .btn-primary {
            background-color: var(--accent-primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            color: white;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.6);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            padding: 12px 16px;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-control:focus {
            background-color: white;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px var(--shadow-color);
            outline: none;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 15px 20px;
            border-radius: 16px;
        }

        .nav-link {
            color: var(--text-primary);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: var(--accent-primary);
            color: white;
        }

        .card {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            padding: 25px;
            margin: 10px 0;
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 0 0 15px 0;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 300;
        }

        .table {
            color: var(--text-primary);
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            border-bottom: 2px solid var(--border-color);
            padding: 12px;
            text-align: left;
            font-weight: 500;
        }

        .table td {
            border-bottom: 1px solid var(--border-color);
            padding: 12px;
        }

        .table-hover tbody tr:hover {
            background: rgba(196, 181, 214, 0.1);
        }

        .progress {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            height: 8px;
            overflow: hidden;
        }

        .progress-bar {
            background: var(--accent-primary);
            border-radius: 30px;
        }

        .modal-content {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            padding: 20px;
        }

        .modal-header, .modal-footer {
            border: none;
            padding: 15px 0;
        }

        .list-group-item {
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 12px !important;
            margin-bottom: 8px;
            color: var(--text-primary);
            padding: 12px 16px;
        }

        .list-group-item-action:hover {
            background: var(--accent-primary);
            color: white;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
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
