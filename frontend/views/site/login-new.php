<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в систему</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 40px 35px;
            max-width: 420px;
            width: 100%;
            transition: all 0.2s ease;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            max-width: 100%;
            height: auto;
            max-height: 120px; /* чтоб не расползался, если большой */
            object-fit: contain;
        }

        .login-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .login-subtitle {
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 28px;
        }

        .form-control {
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            padding: 12px 16px;
            background-color: #f8fafc;
            transition: all 0.2s;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background-color: #ffffff;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .form-check-label {
            font-size: 14px;
            color: #475569;
        }

        .btn-login {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: background 0.2s, box-shadow 0.2s;
            margin-top: 8px;
        }

        .btn-login:hover {
            background-color: #1d4ed8;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.25);
            color: #fff;
        }

        .btn-login:active {
            background-color: #1e40af;
        }

        .login-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
        }

        .login-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .divider {
            border-top: 1px solid #e2e8f0;
            margin: 24px 0 18px;
        }

        .btn-register {
            background-color: transparent;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            font-weight: 500;
            font-size: 15px;
            color: #1e293b;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-register:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        /* маленькие фиксы для полей ввода */
        .field-loginform-username,
        .field-loginform-password {
            margin-bottom: 18px;
        }

        /* скрываем стандартные лейблы Yii, если используем свои */
        .field-loginform-username label,
        .field-loginform-password label {
            font-weight: 500;
            color: #334155;
            font-size: 13px;
            margin-bottom: 4px;
        }

        /* чекбокс "запомнить" */
        .field-loginform-rememberme {
            margin-top: 6px;
            margin-bottom: 6px;
        }

        /* ошибки валидации — аккуратные */
        .help-block {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="login-container">

    <!-- Логотип -->
    <div class="login-logo">
        <img src="/uploads/logo.png" alt="Логотип">
    </div>

    <!-- Заголовок -->
    <div class="login-title">Добро пожаловать</div>
    <div class="login-subtitle">Войдите, чтобы продолжить</div>

    <!-- Форма -->
    <?php $form = \yii\widgets\ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['autocomplete' => 'off']
    ]); ?>

    <?= $form->field($model, 'username')
        ->textInput([
            'autofocus' => true,
            'placeholder' => 'Введите логин или email'
        ])
        ->label('Логин') ?>

    <?= $form->field($model, 'password')
        ->passwordInput(['placeholder' => 'Введите пароль'])
        ->label('Пароль') ?>

    <?= $form->field($model, 'rememberMe')
        ->checkbox(['label' => 'Запомнить меня'])
        ->label(false) // убираем дублирующий лейбл, оставляем только текст чекбокса
    ?>

    <button type="submit" class="btn-login">Войти</button>

    <?php \yii\widgets\ActiveForm::end(); ?>

    <!-- Ссылка "Забыли пароль?" -->
    <div style="text-align: right; margin-top: 12px;">
        <a href="#" style="font-size: 13px; color: #2563eb; text-decoration: none;">Забыли пароль?</a>
    </div>

    <div class="divider"></div>

    <!-- Кнопка регистрации -->
    <a href="<?= \yii\helpers\Url::to(['/site/signup']) ?>" class="btn-register text-center" style="display: block;">
        Создать аккаунт
    </a>

    <!-- Футер -->
    <div class="login-footer">
        © 2026 Все права защищены
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>