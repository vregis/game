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
            --lavender-light: #ece4f0;
            --lavender-mid: #d8cce6;
            --lavender-soft: #c4b5d6;
            --lavender-pink: #e8d5e6;
            --lavender-dark: #4a3f5c;
            --lavender-text: #3d3547;
        }

        body {
            background: linear-gradient(135deg, var(--lavender-light), var(--lavender-mid));
            color: var(--lavender-text);
            font-family: 'Segoe UI', 'Arial', sans-serif;
            padding: 30px;
            min-height: 100vh;
        }

        h1, h2, h3 {
            color: var(--lavender-dark);
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .btn {
            background: var(--lavender-soft);
            border: none;
            color: white;
            padding: 10px 28px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 15px;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            background: var(--lavender-dark);
            transform: scale(1.02);
        }

        .card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            padding: 25px;
            margin: 10px 0;
            box-shadow: 0 4px 15px rgba(74, 63, 92, 0.06);
        }

        input, textarea {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 12px;
            color: var(--lavender-text);
            padding: 12px 16px;
            font-family: 'Segoe UI', sans-serif;
            width: 100%;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--lavender-soft);
            background: white;
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
