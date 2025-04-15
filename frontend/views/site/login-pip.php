<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pip-Boy Auth</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --pip-boy-green: #14fe17;
            --pip-boy-dark: #072100;
            --pip-boy-bg: #0a2e07;
        }

        body {
            background-color: var(--pip-boy-dark);
            color: var(--pip-boy-green);
            font-family: 'Courier New', monospace;
            background-image:
                    radial-gradient(circle at center, var(--pip-boy-bg) 0%, var(--pip-boy-dark) 100%),
                    url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%2314fe17" stroke-width="0.5"/></svg>');
            background-size: 100px 100px;
        }

        .pip-container {
            border: 3px solid var(--pip-boy-green);
            border-radius: 5px;
            box-shadow: 0 0 15px var(--pip-boy-green);
            background-color: rgba(10, 46, 7, 0.8);
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .pip-container::before {
            content: "";
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px solid var(--pip-boy-green);
            border-radius: 8px;
            opacity: 0.3;
            pointer-events: none;
        }

        .pip-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .pip-header h2 {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 5px var(--pip-boy-green);
        }

        .pip-header::after {
            content: "";
            display: block;
            height: 2px;
            background: var(--pip-boy-green);
            margin-top: 10px;
            box-shadow: 0 0 5px var(--pip-boy-green);
        }

        .form-control {
            background-color: transparent;
            border: 2px solid var(--pip-boy-green);
            color: var(--pip-boy-green);
            border-radius: 0;
            margin-bottom: 20px;
        }

        .form-control:focus {
            background-color: rgba(20, 254, 23, 0.1);
            border-color: var(--pip-boy-green);
            color: var(--pip-boy-green);
            box-shadow: 0 0 10px var(--pip-boy-green);
        }

        .btn-pip {
            background-color: transparent;
            border: 2px solid var(--pip-boy-green);
            color: var(--pip-boy-green);
            padding: 10px 30px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn-pip:hover {
            background-color: var(--pip-boy-green);
            color: var(--pip-boy-dark);
            box-shadow: 0 0 15px var(--pip-boy-green);
        }

        .pip-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
        }

        .scanline {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: rgba(20, 254, 23, 0.5);
            animation: scan 8s linear infinite;
            pointer-events: none;
        }

        @keyframes scan {
            0% { top: 0; }
            100% { top: 100%; }
        }
    </style>
</head>
<body>
<div class="pip-container">
    <div class="scanline"></div>
    <div class="pip-header">
        <h2>Pip-Boy 3000</h2>
        <span>Vault-Tec Authentication System</span>
    </div>

    <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Enter Vault ID (e.g. 101)']) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <button type="submit" class="btn btn-pip">Авторизация</button>
    <?php \yii\widgets\ActiveForm::end(); ?>

    <div class="pip-footer">
        <p>Vault-Tec Industries © 2077</p>
        <p>System v3.1.5</p>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>