<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= \yii\helpers\Html::encode($game->name) ?> | Забава</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ===== ХЕДЕР ===== */
        header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 20px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(8px);
            background: rgba(255,255,255,0.92);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo img {
            max-height: 48px;
            width: auto;
            object-fit: contain;
        }

        .logo-text h1 {
            font-size: 22px;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .logo-text p {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 2px;
            font-weight: 400;
        }

        /* ===== ОСНОВНОЙ КОНТЕНТ ===== */
        main {
            flex: 1;
            padding: 48px 0;
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            gap: 32px;
            max-width: 720px;
            margin: 0 auto;
        }

        .panel {
            background: #ffffff;
            border-radius: 20px;
            padding: 32px 36px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04), 0 1px 4px rgba(0, 0, 0, 0.02);
            border: 1px solid #f1f5f9;
            transition: box-shadow 0.2s;
        }

        .panel:hover {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        }

        .panel-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
            line-height: 1.25;
        }

        .panel-title span {
            color: #2563eb;
        }

        /* ===== КОНТЕНТ ИГРЫ ===== */
        .game-content {
            font-size: 15px;
            color: #334155;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .game-content p {
            margin-bottom: 14px;
        }

        .game-content p:last-child {
            margin-bottom: 0;
        }

        .game-content ul,
        .game-content ol {
            padding-left: 22px;
            margin-bottom: 14px;
        }

        .game-content li {
            margin-bottom: 6px;
        }

        .game-content h1,
        .game-content h2,
        .game-content h3,
        .game-content h4 {
            color: #0f172a;
            font-weight: 600;
            margin: 20px 0 10px;
            line-height: 1.3;
        }

        .game-content h3 { font-size: 18px; }
        .game-content h4 { font-size: 16px; }

        .game-content a {
            color: #2563eb;
            text-decoration: none;
            border-bottom: 1px solid rgba(37, 99, 235, 0.3);
            transition: border-color 0.2s;
        }

        .game-content a:hover {
            border-bottom-color: #2563eb;
        }

        .game-content strong {
            color: #0f172a;
            font-weight: 600;
        }

        /* ===== КНОПКИ ===== */
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            padding-top: 8px;
            border-top: 1px solid #f1f5f9;
            margin-top: 8px;
            padding-top: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 28px;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1.5px solid transparent;
            transition: all 0.2s;
            letter-spacing: -0.1px;
            line-height: 1;
        }

        .btn-primary {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #ffffff;
            color: #334155;
            border-color: #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        /* ===== ФУТЕР ===== */
        footer {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 20px 0;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* ===== АДАПТИВ (часть про футер) ===== */
        @media (max-width: 640px) {
            /* ...остальное как было... */

            .footer-content {
                /* ничего особенного — кнопка и так по центру */
            }
        }

        .copyright {
            font-size: 13px;
            color: #94a3b8;
        }

        .copyright strong {
            color: #1e293b;
            font-weight: 500;
        }

        .year {
            font-size: 16px;
            font-weight: 600;
            color: #2563eb;
            background: #eff6ff;
            padding: 4px 16px;
            border-radius: 20px;
        }

        /* ===== АДАПТИВ ===== */
        @media (max-width: 640px) {
            .header-content {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .logo {
                justify-content: center;
            }

            .panel {
                padding: 22px 20px;
            }

            .panel-title {
                font-size: 22px;
            }

            .content-wrapper {
                padding: 0 4px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- ===== ХЕДЕР ===== -->
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <img src="/uploads/logo.png" alt="Логотип">
                <div class="logo-text">
                    <h1>Забава</h1>
                    <p>Приключения в реальности</p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- ===== ОСНОВНОЙ КОНТЕНТ ===== -->
<main>
    <div class="container">
        <div class="content-wrapper">
            <section class="panel">
                <h2 class="panel-title"><?= \yii\helpers\Html::encode($game->name) ?></h2>

                <div class="game-content">
                    <?= $game->text ?>
                </div>

                <div class="actions">
                    <a href="/frontend/web/<?= \yii\helpers\Html::encode($game->getGameTypeFrontUrl()) ?>/new-game?id=<?= \yii\helpers\Html::encode($game->url) ?>"
                       class="btn btn-primary">К ИГРЕ</a>
                    <a href="/" class="btn btn-secondary">НАЗАД</a>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- ===== ФУТЕР ===== -->
<footer>
    <div class="container">
        <div class="footer-content">
            <a href="<?php echo \yii\helpers\Url::to(['/site/feedback'])?>" target="_blank" class="btn btn-primary">Сообщить об ошибке</a>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const year = new Date().getFullYear();
        document.getElementById('current-year').textContent = year;
        document.getElementById('dynamic-year').textContent = year;
    });
</script>

</body>
</html>