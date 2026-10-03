<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .nav-link {
            display: none;
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
            max-height: 120px;
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
            color: #1e293b;
        }

        /* поля формы */
        .field-signupform-username,
        .field-signupform-email,
        .field-signupform-phone,
        .field-signupform-password {
            margin-bottom: 18px;
        }

        .field-signupform-username label,
        .field-signupform-email label,
        .field-signupform-phone label,
        .field-signupform-password label {
            font-weight: 500;
            color: #334155;
            font-size: 13px;
            margin-bottom: 4px;
        }

        /* опциональная пометка у телефона */
        .label-optional {
            color: #94a3b8;
            font-weight: 400;
            font-size: 12px;
            margin-left: 4px;
        }

        /* чекбокс согласия */
        .field-signupform-agree {
            margin-top: 6px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .field-signupform-agree input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            flex-shrink: 0;
            accent-color: #2563eb;
            cursor: pointer;
        }

        .field-signupform-agree label {
            font-size: 13px;
            color: #475569;
            line-height: 1.5;
            margin: 0;
            cursor: pointer;
        }

        .field-signupform-agree label a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .field-signupform-agree label a:hover {
            text-decoration: underline;
        }

        /* ошибки валидации */
        .help-block {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
        }

        /* кнопка отправки */
        .form-group .btn {
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

        .form-group .btn:hover {
            background-color: #1d4ed8;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.25);
        }

        .form-group .btn:active {
            background-color: #1e40af;
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
    <div class="login-title">Создать аккаунт</div>
    <div class="login-subtitle">Заполните форму, чтобы зарегистрироваться</div>

    <!-- Форма -->
    <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($model, 'username')
        ->textInput([
            'autofocus' => true,
            'placeholder' => 'Введите логин',
        ])
        ->label('Логин') ?>

    <?= $form->field($model, 'email')
        ->textInput([
            'type' => 'email',
            'placeholder' => 'your@email.com',
        ])
        ->label('Email') ?>

    <?= $form->field($model, 'phone')
        ->textInput([
            'type' => 'tel',
            'placeholder' => '+7 (___) ___-__-__',
        ])
        ->label('Телефон <span class="label-optional">(необязательно)</span>', ['encode' => false]) ?>

    <?= $form->field($model, 'password')
        ->passwordInput([
            'placeholder' => 'Введите пароль',
        ])
        ->label('Пароль') ?>

    <?= $form->field($model, 'agree')
        ->checkbox([
            'label' => 'Я согласен с <a href="' . \yii\helpers\Url::to(['site/privacy']) . '" target="_blank">политикой обработки персональных данных</a>',
            'labelOptions' => ['encode' => false, 'required' => true],
        ])
        ->label(false) ?>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Зарегистрироваться', [
            'class' => 'btn',
            'name' => 'signup-button',
        ]) ?>
    </div>

    <?php \yii\widgets\ActiveForm::end(); ?>

    <div class="divider"></div>

    <!-- Ссылка на вход -->
    <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="btn-register text-center" style="display: block;">
        Уже есть аккаунт? Войти
    </a>

    <!-- Футер -->
    <div class="login-footer">
        © <?= date('Y') ?> Все права защищены
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>