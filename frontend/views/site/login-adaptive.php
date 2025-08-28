<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .login-header h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            border-radius: 3px;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
            margin-top: 15px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 0 2px rgba(106, 17, 203, 0.2);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .forgot-password {
            color: #6a11cb;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #2575fc;
            text-decoration: underline;
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }

        .signup-link a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .signup-link a:hover {
            color: #2575fc;
            text-decoration: underline;
        }

        .decoration {
            position: absolute;
            z-index: -1;
        }

        .decoration-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(106, 17, 203, 0.2) 0%, rgba(37, 117, 252, 0.2) 100%);
        }

        .circle-1 {
            top: -70px;
            right: -70px;
        }

        .circle-2 {
            bottom: -70px;
            left: -70px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 0 15px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }

        /* Анимации */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-container {
            animation: fadeIn 0.5s ease-out;
        }

        .form-group {
            animation: fadeIn 0.5s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .remember-forgot { animation: fadeIn 0.5s ease-out 0.4s both; }
        .btn-login { animation: fadeIn 0.5s ease-out 0.5s both; }
        .signup-link { animation: fadeIn 0.5s ease-out 0.6s both; }
    </style>
</head>
<body>
<div class="login-container">
    <div class="decoration decoration-circle circle-1"></div>
    <div class="decoration decoration-circle circle-2"></div>

    <div class="login-header">
        <h1>Добро пожаловать</h1>
        <p>Введите ваши учетные данные для входа в систему</p>
    </div>

    <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => '']) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <button type="submit" class="btn-login">Авторизация</button>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

<script>
    // Простая валидация формы
    document.querySelector('form').addEventListener('submit', function(e) {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (!username || !password) {
            e.preventDefault();
            alert('Пожалуйста, заполните все поля');
            return false;
        }
    });
</script>
</body>
</html>