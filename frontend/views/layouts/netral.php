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
        :root {
            --bg-light: #f5f5f5;
            --bg-card: rgba(255, 255, 255, 0.7);
            --text-dark: #2d2d2d;
            --text-muted: #6b6b6b;
            --accent-soft: #c9c9c9;
            --accent-hover: #a8a8a8;
        }

        body {
            background: var(--bg-light);
            color: var(--text-dark);
            font-family: 'Segoe UI', 'Arial', sans-serif;
            padding: 30px;
        }

        .btn {
            background: var(--accent-soft);
            border: none;
            color: white;
            padding: 10px 28px;
            border-radius: 30px;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--accent-hover);
        }

        .card {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            padding: 25px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <a class="btn" style="position:absolute; top:20px; right:20px; z-index:9999" href="/frontend/web/site/logout">Выйти</a>
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
