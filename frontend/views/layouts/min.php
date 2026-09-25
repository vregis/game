<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap');

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
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            /* ===== ПАЛИТРА И ШРИФТ ===== */
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

                /* Перекрываем AdminLTE-шные дефолты */
                --blue: #2563eb;
                --lightblue: #3b82f6;
            }

            body,
            .content-wrapper,
            .main-sidebar,
            .main-header,
            .main-footer {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
            }

            body {
                background-color: var(--app-bg) !important;
                color: var(--app-text);
                font-size: 14px;
                line-height: 1.6;
            }

            /* Заголовки */
            h1, h2, h3, h4, h5, h6 {
                color: var(--app-text-strong);
                font-weight: 600;
                letter-spacing: -0.3px;
            }

            /* ===== НАВБАР ===== */
            .main-header.navbar {
                background-color: var(--app-surface) !important;
                border-bottom: 1px solid var(--app-border) !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
                padding: 12px 20px;
            }

            .main-header .nav-link {
                color: var(--app-text) !important;
                border-radius: 8px;
                transition: all 0.2s;
            }

            .main-header .nav-link:hover {
                background: var(--app-accent-soft);
                color: var(--app-accent) !important;
            }

            /* Логотип */
            .brand-link {
                border-bottom: 1px solid var(--app-border) !important;
                color: var(--app-text-strong) !important;
                font-weight: 600;
            }

            .brand-link:hover {
                color: var(--app-accent) !important;
            }

            /* ===== САЙДБАР ===== */
            .main-sidebar {
                background-color: var(--app-surface) !important;
                border-right: 1px solid var(--app-border);
                box-shadow: none !important;
            }

            .main-sidebar .nav-sidebar .nav-link {
                color: var(--app-text-soft) !important;
                border-radius: 10px;
                margin: 2px 10px;
                padding: 10px 14px;
                transition: all 0.2s;
                font-weight: 500;
            }

            .main-sidebar .nav-sidebar .nav-link:hover {
                background: var(--app-accent-soft) !important;
                color: var(--app-accent) !important;
            }

            .main-sidebar .nav-sidebar .nav-link.active,
            .main-sidebar .nav-sidebar .nav-link.active:hover {
                background: var(--app-accent) !important;
                color: #ffffff !important;
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            }

            .main-sidebar .nav-sidebar .nav-link .nav-icon {
                color: inherit !important;
            }

            .main-sidebar .nav-header {
                color: var(--app-text-muted) !important;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.6px;
                font-weight: 600;
                padding: 14px 18px 6px;
            }

            /* ===== КОНТЕНТ ===== */
            .content-wrapper {
                background-color: var(--app-bg) !important;
            }

            .content-header {
                padding: 24px 24px 8px;
            }

            .content-header h1 {
                font-size: 24px;
                font-weight: 700;
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
                box-shadow: none;
            }

            .btn:focus,
            .btn.focus {
                outline: none;
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
            }

            .btn-primary {
                background: var(--app-accent) !important;
                border-color: var(--app-accent) !important;
                color: #ffffff !important;
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            }

            .btn-primary:hover,
            .btn-primary:focus {
                background: var(--app-accent-hover) !important;
                border-color: var(--app-accent-hover) !important;
                box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
                transform: translateY(-1px);
            }

            .btn-primary:active {
                transform: translateY(0);
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

            .btn-success {
                background: #10b981 !important;
                border-color: #10b981 !important;
                color: #fff !important;
            }
            .btn-success:hover {
                background: #059669 !important;
                border-color: #059669 !important;
            }

            .btn-danger {
                background: #ef4444 !important;
                border-color: #ef4444 !important;
                color: #fff !important;
            }
            .btn-danger:hover {
                background: #dc2626 !important;
                border-color: #dc2626 !important;
            }

            .btn-warning {
                background: #f59e0b !important;
                border-color: #f59e0b !important;
                color: #fff !important;
            }
            .btn-warning:hover {
                background: #d97706 !important;
                border-color: #d97706 !important;
            }

            .btn-info {
                background: #3b82f6 !important;
                border-color: #3b82f6 !important;
                color: #fff !important;
            }

            .btn-sm {
                padding: 6px 14px;
                font-size: 13px;
                border-radius: 10px;
            }

            .btn-lg {
                padding: 14px 28px;
                font-size: 15px;
                border-radius: 14px;
            }

            /* ===== КАРТОЧКИ ===== */
            .card {
                background: var(--app-surface);
                border: 1px solid var(--app-border-soft);
                border-radius: var(--app-radius-lg);
                box-shadow: var(--app-shadow);
                transition: box-shadow 0.2s;
                margin-bottom: 20px;
            }

            .card:hover {
                box-shadow: var(--app-shadow-hover);
            }

            .card-header {
                background: transparent;
                border-bottom: 1px solid var(--app-border-soft);
                padding: 18px 22px;
                font-weight: 600;
                font-size: 16px;
                color: var(--app-text-strong);
                border-radius: var(--app-radius-lg) var(--app-radius-lg) 0 0;
            }

            .card-body {
                padding: 22px;
            }

            .card-footer {
                background: transparent;
                border-top: 1px solid var(--app-border-soft);
                padding: 16px 22px;
            }

            /* ===== ФОРМЫ ===== */
            .form-control,
            .custom-select,
            .custom-file-label {
                background-color: var(--app-bg);
                border: 1.5px solid var(--app-border);
                border-radius: var(--app-radius);
                color: var(--app-text);
                font-family: 'Inter', sans-serif;
                font-size: 14px;
                padding: 10px 14px;
                height: auto;
                transition: all 0.2s;
            }

            .form-control:focus,
            .custom-select:focus {
                background-color: var(--app-surface);
                border-color: var(--app-accent);
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
                color: var(--app-text);
                outline: none;
            }

            .form-control::placeholder {
                color: var(--app-text-muted);
            }

            .form-group label,
            .control-label {
                font-size: 13px;
                font-weight: 500;
                color: #334155;
                margin-bottom: 6px;
            }

            .form-text,
            .help-block {
                font-size: 12px;
                color: var(--app-text-muted);
                margin-top: 4px;
            }

            /* Валидация */
            .has-error .form-control,
            .form-control.is-invalid {
                border-color: #ef4444;
            }

            .has-error .help-block,
            .invalid-feedback {
                color: #ef4444;
                font-size: 12px;
            }

            /* ===== ТАБЛИЦЫ ===== */
            .table {
                color: var(--app-text);
                background: var(--app-surface);
                border-radius: var(--app-radius);
                overflow: hidden;
            }

            .table thead th {
                background: var(--app-bg);
                border-bottom: 1px solid var(--app-border);
                border-top: none;
                padding: 14px 16px;
                text-align: left;
                font-weight: 600;
                font-size: 13px;
                color: var(--app-text-soft);
                text-transform: uppercase;
                letter-spacing: 0.4px;
            }

            .table tbody td {
                border-top: 1px solid var(--app-border-soft);
                padding: 14px 16px;
                vertical-align: middle;
            }

            .table-hover tbody tr:hover {
                background: var(--app-accent-soft);
            }

            /* ===== ПАГИНАЦИЯ ===== */
            .pagination .page-link {
                color: var(--app-text);
                border: 1px solid var(--app-border);
                border-radius: 10px !important;
                margin: 0 3px;
                padding: 8px 14px;
                transition: all 0.2s;
            }

            .pagination .page-link:hover {
                background: var(--app-accent-soft);
                color: var(--app-accent);
                border-color: var(--app-accent);
            }

            .pagination .page-item.active .page-link {
                background: var(--app-accent);
                border-color: var(--app-accent);
                color: #fff;
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            }

            .pagination .page-item.disabled .page-link {
                color: var(--app-text-muted);
                background: var(--app-bg);
            }

            /* ===== МОДАЛКИ ===== */
            .modal-content {
                background: var(--app-surface);
                border: none;
                border-radius: var(--app-radius-lg);
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
                overflow: hidden;
            }

            .modal-header {
                border-bottom: 1px solid var(--app-border-soft);
                padding: 18px 24px;
            }

            .modal-title {
                font-weight: 600;
                color: var(--app-text-strong);
            }

            .modal-body {
                padding: 24px;
            }

            .modal-footer {
                border-top: 1px solid var(--app-border-soft);
                padding: 16px 24px;
            }

            /* ===== LIST GROUP ===== */
            .list-group-item {
                background: var(--app-surface);
                border: 1px solid var(--app-border-soft);
                border-radius: var(--app-radius) !important;
                margin-bottom: 6px;
                color: var(--app-text);
                padding: 12px 16px;
            }

            .list-group-item-action:hover {
                background: var(--app-accent-soft);
                color: var(--app-accent);
                border-color: var(--app-border);
            }

            /* ===== BADGES ===== */
            .badge {
                border-radius: 8px;
                padding: 5px 10px;
                font-weight: 600;
                font-size: 11px;
                letter-spacing: 0.3px;
            }

            .badge-primary {
                background: var(--app-accent);
                color: #fff;
            }

            /* ===== ALERTS ===== */
            .alert {
                border: none;
                border-radius: var(--app-radius);
                padding: 16px 20px;
                font-size: 14px;
            }

            .alert-success { background: #ecfdf5; color: #065f46; }
            .alert-danger  { background: #fef2f2; color: #991b1b; }
            .alert-warning { background: #fffbeb; color: #92400e; }
            .alert-info    { background: var(--app-accent-soft); color: #1e40af; }

            /* ===== PROGRESS ===== */
            .progress {
                background: var(--app-border-soft);
                border-radius: 30px;
                height: 8px;
                overflow: hidden;
            }

            .progress-bar {
                background: var(--app-accent);
                border-radius: 30px;
            }

            /* ===== NAV TABS ===== */
            .nav-tabs {
                border-bottom: 1px solid var(--app-border);
            }

            .nav-tabs .nav-link {
                border: none;
                color: var(--app-text-soft);
                padding: 10px 18px;
                border-radius: var(--app-radius) var(--app-radius) 0 0;
                font-weight: 500;
                transition: all 0.2s;
            }

            .nav-tabs .nav-link:hover {
                color: var(--app-accent);
                background: var(--app-accent-soft);
            }

            .nav-tabs .nav-link.active {
                color: var(--app-accent);
                border-bottom: 2px solid var(--app-accent);
                background: transparent;
            }

            /* ===== ФУТЕР ===== */
            .main-footer {
                background: var(--app-surface) !important;
                border-top: 1px solid var(--app-border) !important;
                color: var(--app-text-muted) !important;
                padding: 16px 24px;
                font-size: 13px;
            }

            /* Ссылки */
            a {
                color: var(--app-accent);
            }
            a:hover {
                color: var(--app-accent-hover);
            }

            /* Убираем артефакты старых тем */
            .pipboy-scanline {
                display: none !important;
            }

            /* ===== АДАПТИВ ===== */
            @media (max-width: 640px) {
                .content-header h1 {
                    font-size: 20px;
                }
                .card-body {
                    padding: 16px;
                }
                .btn {
                    padding: 9px 18px;
                }
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
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
    </body>
    </html>
<?php $this->endPage() ?>