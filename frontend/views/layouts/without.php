<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

// AdminLTE-ассеты подключаем — они тянут Bootstrap 4, jQuery, плагины
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);

// Inter — наш основной шрифт
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

// control_sidebar.js всё равно регистрируем, если он нужен другим скриптам
$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1].'/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);

$user = Yii::$app->user->identity;
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
            /* ===== ПЕРЕМЕННЫЕ (палитра логина) ===== */
            :root {
                --app-bg: #f8fafc;
                --app-surface: #ffffff;
                --app-border: #e2e8f0;
                --app-border-soft: #f1f5f9;
                --app-text: #1e293b;
                --app-text-strong: #0f172a;
                --app-text-muted: #94a3b8;
                --app-text-soft: #64748b;
                --app-accent: #2563eb;
                --app-accent-hover: #1d4ed8;
                --app-accent-soft: #eff6ff;
                --app-shadow: 0 4px 16px rgba(0, 0, 0, 0.04), 0 1px 4px rgba(0, 0, 0, 0.02);
                --app-shadow-hover: 0 8px 32px rgba(0, 0, 0, 0.06);
                --app-radius: 12px;
                --app-radius-lg: 20px;
            }

            /* ===== СБРОСЫ ADMINLTE ===== */
            html, body {
                height: auto !important;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                background-color: var(--app-bg) !important;
                color: var(--app-text);
                font-size: 14px;
                line-height: 1.6;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                padding: 0 !important;
                margin: 0 !important;
                -webkit-font-smoothing: antialiased;
            }

            /* Скрываем всё AdminLTE-шное, что могло остаться */
            .main-sidebar,
            .main-header,
            .main-footer,
            .control-sidebar,
            .content-header,
            .navbar,
            .brand-link,
            .sidebar,
            .pipboy-scanline {
                display: none !important;
            }

            /* Обёртка контента AdminLTE — оставляем, но без смещений */
            .wrapper {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                background: transparent !important;
            }

            .content-wrapper {
                background: transparent !important;
                margin: 0 !important;
                padding: 0 !important;
                min-height: auto !important;
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            /* ===== БАЗА ===== */
            * {
                box-sizing: border-box;
            }

            a {
                color: var(--app-accent);
                text-decoration: none;
                transition: color 0.2s;
            }

            a:hover {
                color: var(--app-accent-hover);
                text-decoration: none;
            }

            h1, h2, h3, h4, h5, h6 {
                color: var(--app-text-strong);
                font-weight: 600;
                letter-spacing: -0.3px;
                line-height: 1.3;
                margin: 0;
            }

            h1 { font-size: 26px; }
            h2 { font-size: 22px; }
            h3 { font-size: 18px; }

            p { margin: 0 0 10px; }
            p:last-child { margin-bottom: 0; }

            .container,
            .container-fluid {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 24px;
                width: 100%;
            }

            /* ===== ХЕДЕР ===== */
            .app-header {
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                border-bottom: 1px solid var(--app-border);
                padding: 16px 0;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
                position: sticky;
                top: 0;
                z-index: 100;
            }

            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 24px;
                flex-wrap: wrap;
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 14px;
                text-decoration: none;
                color: inherit;
            }

            .logo img {
                max-height: 48px;
                width: auto;
                object-fit: contain;
            }

            .logo-text h1 {
                font-size: 22px;
                font-weight: 600;
                color: var(--app-text-strong);
                letter-spacing: -0.3px;
                line-height: 1.2;
            }

            .logo-text p {
                font-size: 13px;
                color: var(--app-text-muted);
                margin-top: 2px;
                font-weight: 400;
                line-height: 1.2;
                margin-bottom: 0;
            }

            /* Навигация в хедере */
            .nav {
                display: flex;
                align-items: center;
                gap: 4px;
                flex-wrap: wrap;
            }

            .nav-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                border-radius: 10px;
                color: var(--app-text-soft);
                font-weight: 500;
                font-size: 14px;
                transition: all 0.2s;
                text-decoration: none;
                white-space: nowrap;
            }

            .nav-link:hover {
                background: var(--app-accent-soft);
                color: var(--app-accent);
            }

            .nav-link.active {
                background: var(--app-accent);
                color: #ffffff;
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            }

            /* Меню пользователя */
            .user-menu {
                position: relative;
            }

            .user-menu-toggle {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 6px 14px 6px 6px;
                border-radius: 30px;
                background: var(--app-bg);
                border: 1px solid var(--app-border);
                cursor: pointer;
                font-size: 14px;
                color: var(--app-text);
                font-weight: 500;
                transition: all 0.2s;
                font-family: inherit;
            }

            .user-menu-toggle:hover {
                border-color: var(--app-accent);
                color: var(--app-accent);
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: var(--app-accent);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                font-size: 14px;
            }

            .user-menu-dropdown {
                position: absolute;
                top: calc(100% + 8px);
                right: 0;
                min-width: 200px;
                background: var(--app-surface);
                border: 1px solid var(--app-border);
                border-radius: var(--app-radius);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
                padding: 6px;
                display: none;
                z-index: 200;
            }

            .user-menu.open .user-menu-dropdown {
                display: block;
            }

            .user-menu-dropdown a,
            .user-menu-dropdown button {
                display: block;
                width: 100%;
                text-align: left;
                padding: 9px 14px;
                color: var(--app-text);
                border-radius: 8px;
                font-size: 14px;
                transition: all 0.15s;
                background: none;
                border: none;
                cursor: pointer;
                font-family: inherit;
            }

            .user-menu-dropdown a:hover,
            .user-menu-dropdown button:hover {
                background: var(--app-accent-soft);
                color: var(--app-accent);
            }

            .user-menu-dropdown hr {
                border: none;
                border-top: 1px solid var(--app-border-soft);
                margin: 6px 0;
            }

            /* ===== MAIN ===== */
            .app-main {
                flex: 1;
                padding: 32px 0;
            }

            /* ===== КНОПКИ ===== */
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 10px 22px;
                border-radius: var(--app-radius);
                font-family: 'Inter', sans-serif;
                font-size: 14px;
                font-weight: 600;
                border: 1.5px solid transparent;
                transition: all 0.2s;
                letter-spacing: -0.1px;
                line-height: 1.4;
                text-decoration: none;
                cursor: pointer;
                background: transparent;
                color: var(--app-text);
                white-space: nowrap;
                box-shadow: none;
            }

            .btn:focus-visible {
                outline: none;
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.25);
            }

            .btn-primary {
                background: var(--app-accent) !important;
                border-color: var(--app-accent) !important;
                color: #ffffff !important;
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            }

            .btn-primary:hover {
                background: var(--app-accent-hover) !important;
                border-color: var(--app-accent-hover) !important;
                color: #ffffff !important;
                box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
                transform: translateY(-1px);
            }

            .btn-secondary,
            .btn-default {
                background: var(--app-surface) !important;
                border-color: var(--app-border) !important;
                color: var(--app-text) !important;
            }

            .btn-secondary:hover,
            .btn-default:hover {
                background: var(--app-bg) !important;
                border-color: #cbd5e1 !important;
                color: var(--app-text-strong) !important;
            }

            .btn-success { background: #10b981 !important; border-color: #10b981 !important; color: #fff !important; }
            .btn-success:hover { background: #059669 !important; border-color: #059669 !important; color: #fff !important; }

            .btn-danger { background: #ef4444 !important; border-color: #ef4444 !important; color: #fff !important; }
            .btn-danger:hover { background: #dc2626 !important; border-color: #dc2626 !important; color: #fff !important; }

            .btn-warning { background: #f59e0b !important; border-color: #f59e0b !important; color: #fff !important; }
            .btn-warning:hover { background: #d97706 !important; border-color: #d97706 !important; color: #fff !important; }

            .btn-info { background: #3b82f6 !important; border-color: #3b82f6 !important; color: #fff !important; }

            .btn-sm { padding: 6px 14px; font-size: 13px; border-radius: 10px; }
            .btn-lg { padding: 14px 28px; font-size: 15px; border-radius: 14px; }
            .btn-block { width: 100%; }

            /* ===== КАРТОЧКИ ===== */
            .card {
                background: var(--app-surface) !important;
                border: 1px solid var(--app-border-soft) !important;
                border-radius: var(--app-radius-lg) !important;
                box-shadow: var(--app-shadow) !important;
                transition: box-shadow 0.2s;
                margin-bottom: 20px;
                overflow: hidden;
            }

            .card:hover {
                box-shadow: var(--app-shadow-hover) !important;
            }

            .card-header {
                background: transparent !important;
                border-bottom: 1px solid var(--app-border-soft) !important;
                padding: 18px 22px;
                font-weight: 600;
                font-size: 16px;
                color: var(--app-text-strong);
            }

            .card-body { padding: 22px; }
            .card-footer {
                background: transparent !important;
                border-top: 1px solid var(--app-border-soft) !important;
                padding: 16px 22px;
            }

            /* ===== ФОРМЫ ===== */
            .form-group { margin-bottom: 18px; }

            .form-group label,
            .control-label {
                display: block;
                font-size: 13px;
                font-weight: 500;
                color: #334155;
                margin-bottom: 6px;
            }

            .form-control {
                display: block;
                width: 100%;
                background-color: var(--app-bg) !important;
                border: 1.5px solid var(--app-border) !important;
                border-radius: var(--app-radius) !important;
                color: var(--app-text) !important;
                font-family: 'Inter', sans-serif !important;
                font-size: 14px !important;
                padding: 10px 14px !important;
                transition: all 0.2s;
                line-height: 1.5;
                height: auto !important;
            }

            .form-control:focus {
                background-color: var(--app-surface) !important;
                border-color: var(--app-accent) !important;
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08) !important;
                outline: none;
            }

            .form-control::placeholder { color: var(--app-text-muted); }

            .form-text, .help-block {
                font-size: 12px;
                color: var(--app-text-muted);
                margin-top: 4px;
            }

            .has-error .form-control,
            .form-control.is-invalid {
                border-color: #ef4444 !important;
            }

            .has-error .help-block,
            .invalid-feedback {
                color: #ef4444;
                font-size: 12px;
            }

            select.form-control {
                appearance: none;
                -webkit-appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
                background-repeat: no-repeat !important;
                background-position: right 14px center !important;
                padding-right: 40px !important;
            }

            input[type="checkbox"],
            input[type="radio"] {
                accent-color: var(--app-accent);
                width: 16px;
                height: 16px;
                cursor: pointer;
            }

            /* ===== ТАБЛИЦЫ ===== */
            .table {
                width: 100%;
                border-collapse: collapse;
                background: var(--app-surface) !important;
                border-radius: var(--app-radius);
                overflow: hidden;
                font-size: 14px;
                color: var(--app-text) !important;
            }

            .table thead th {
                background: var(--app-bg) !important;
                border-bottom: 1px solid var(--app-border) !important;
                border-top: none !important;
                padding: 14px 16px;
                text-align: left;
                font-weight: 600;
                font-size: 12px;
                color: var(--app-text-soft) !important;
                text-transform: uppercase;
                letter-spacing: 0.4px;
            }

            .table tbody td {
                border-top: 1px solid var(--app-border-soft) !important;
                padding: 14px 16px;
                vertical-align: middle;
            }

            .table-hover tbody tr:hover {
                background: var(--app-accent-soft) !important;
            }

            /* ===== АЛЕРТЫ ===== */
            .alert {
                padding: 16px 20px;
                border-radius: var(--app-radius);
                font-size: 14px;
                margin-bottom: 16px;
                border: none;
            }

            .alert-success { background: #ecfdf5; color: #065f46; }
            .alert-danger  { background: #fef2f2; color: #991b1b; }
            .alert-warning { background: #fffbeb; color: #92400e; }
            .alert-info    { background: var(--app-accent-soft); color: #1e40af; }

            /* ===== BADGE ===== */
            .badge {
                display: inline-block;
                border-radius: 8px;
                padding: 4px 10px;
                font-weight: 600;
                font-size: 11px;
                letter-spacing: 0.3px;
                background: var(--app-accent);
                color: #fff;
            }

            /* ===== ФУТЕР ===== */
            .app-footer {
                background: var(--app-surface);
                border-top: 1px solid var(--app-border);
                padding: 20px 0;
                margin-top: auto;
            }

            .footer-content {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
                font-size: 13px;
                color: var(--app-text-muted);
            }

            .footer-content strong {
                color: var(--app-text);
                font-weight: 500;
            }

            /* ===== АДАПТИВ ===== */
            @media (max-width: 768px) {
                .header-content {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 12px;
                }
                .logo { justify-content: center; }
                .nav { justify-content: center; }
                .user-menu { align-self: center; }
                .container, .container-fluid { padding: 0 16px; }
                .app-main { padding: 24px 0; }
                .card-body { padding: 18px; }
                .btn { padding: 9px 18px; }
                .footer-content { flex-direction: column; text-align: center; }
            }
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <!-- ===== НАШ ХЕДЕР (в стиле логина) ===== -->
        <header class="app-header">
            <div class="container">
                <div class="header-content">

                    <a href="<?= Url::home() ?>" class="logo">
                        <img src="/uploads/logo.png" alt="Логотип">
                        <div class="logo-text">
                            <h1>Забава</h1>
                            <p>Приключения в реальности</p>
                        </div>
                    </a>

                    <nav class="nav">
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <a href="<?= Url::to(['/site/index']) ?>" class="nav-link">Главная</a>
                            <a href="<?= Url::to(['/game/index']) ?>" class="nav-link">Игры</a>

                            <div class="user-menu" id="userMenu">
                                <button type="button" class="user-menu-toggle" onclick="document.getElementById('userMenu').classList.toggle('open')">
                                    <span class="user-avatar"><?= mb_strtoupper(mb_substr($user->username ?? 'U', 0, 1)) ?></span>
                                    <span><?= Html::encode($user->username ?? 'Пользователь') ?></span>
                                </button>
                                <div class="user-menu-dropdown">
                                    <a href="<?= Url::to(['/site/profile']) ?>">Профиль</a>
                                    <a href="<?= Url::to(['/site/settings']) ?>">Настройки</a>
                                    <hr>
                                    <?= Html::beginForm(['/site/logout'], 'post') ?>
                                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                    <?= Html::submitButton('Выйти', ['style' => 'display:block;width:100%;text-align:left;padding:9px 14px;background:none;border:none;color:#1e293b;border-radius:8px;font-size:14px;cursor:pointer;font-family:inherit;']) ?>
                                    <?= Html::endForm() ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="<?= Url::to(['/site/login']) ?>" class="nav-link">Войти</a>
                        <?php endif; ?>
                    </nav>

                </div>
            </div>
        </header>

        <!-- ===== КОНТЕНТ ===== -->
        <div class="content-wrapper">
            <main class="app-main">
                <div class="container">
                    <?= $content ?>
                </div>
            </main>
        </div>

        <!-- ===== ФУТЕР ===== -->
        <footer class="app-footer">
            <div class="container">
                <div class="footer-content">
                    <a href="<?php echo \yii\helpers\Url::to(['/site/feedback'])?>" target="_blank" class="btn btn-primary">Сообщить об ошибке</a>
                </div>
            </div>
        </footer>

    </div>

    <?php $this->endBody() ?>

    <script>
        document.addEventListener('click', function (e) {
            const menu = document.getElementById('userMenu');
            if (menu && !menu.contains(e.target)) {
                menu.classList.remove('open');
            }
        });
    </script>

    </body>
    </html>
<?php $this->endPage() ?>