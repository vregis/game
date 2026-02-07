<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Убежище Vault-Tec | Pip-Boy Interface</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Share Tech Mono', monospace;
            background-color: #001a00;
            color: #00ff00;
            background-image:
                    radial-gradient(circle at 10% 20%, rgba(0, 60, 0, 0.2) 0%, transparent 20%),
                    radial-gradient(circle at 90% 80%, rgba(0, 40, 0, 0.2) 0%, transparent 20%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.7);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Стили для хедера */
        header {
            background-color: #001100;
            border-bottom: 3px solid #00aa00;
            padding: 15px 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.3);
        }

        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                    linear-gradient(90deg, transparent 50%, rgba(0, 255, 0, 0.05) 50%),
                    linear-gradient(rgba(0, 255, 0, 0.05) 50%, transparent 50%);
            background-size: 4px 4px;
            z-index: 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: radial-gradient(circle, #00aa00 30%, #006600 70%);
            border-radius: 50%;
            position: relative;
            border: 2px solid #00ff00;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
        }

        .logo-icon::before {
            content: "V";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Play', sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #001100;
            text-shadow: 0 0 3px #00ff00;
        }

        .logo-text h1 {
            font-family: 'Play', sans-serif;
            font-size: 28px;
            color: #00ff00;
            text-shadow: 0 0 8px rgba(0, 255, 0, 0.8);
            letter-spacing: 1px;
        }

        .logo-text p {
            font-size: 12px;
            color: #00aa00;
            margin-top: 3px;
        }

        .phone {
            background-color: #001a00;
            padding: 10px 20px;
            border: 2px solid #00aa00;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.4);
        }

        .phone-label {
            font-size: 12px;
            color: #00aa00;
            margin-bottom: 5px;
        }

        .phone-number {
            font-family: 'Play', sans-serif;
            font-size: 22px;
            color: #00ff00;
            letter-spacing: 1px;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.7);
        }

        /* Стили для основного контента */
        main {
            flex: 1;
            padding: 40px 0;
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            gap: 40px;
            max-width: 800px;
            margin: 0 auto;
        }

        .panel {
            background-color: rgba(0, 17, 0, 0.9);
            border: 2px solid #00aa00;
            padding: 25px;
            position: relative;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.3);
        }

        .panel::before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 1px solid rgba(0, 255, 0, 0.2);
            pointer-events: none;
        }

        .panel-title {
            font-family: 'Play', sans-serif;
            color: #00ff00;
            font-size: 22px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #00aa00;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 8px rgba(0, 255, 0, 0.8);
        }

        /* Стили для выпадающего списка */
        .dropdown-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .dropdown-label {
            font-size: 16px;
            color: #00ff00;
        }

        .fallout-select {
            background-color: #001a00;
            border: 2px solid #00aa00;
            color: #00ff00;
            font-family: 'Share Tech Mono', monospace;
            font-size: 16px;
            padding: 10px 15px;
            width: 100%;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2300ff00' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            transition: all 0.3s;
            text-shadow: 0 0 3px rgba(0, 255, 0, 0.7);
        }

        .fallout-select:focus {
            outline: none;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.7);
        }

        .fallout-select option {
            background-color: #001100;
            color: #00ff00;
            padding: 10px;
        }

        /* Стили для обычного списка */
        .list-section ul {
            list-style-type: none;
            padding-left: 0;
        }

        .list-section li {
            padding: 12px 15px;
            margin-bottom: 8px;
            background-color: rgba(0, 26, 0, 0.7);
            border-left: 3px solid #00aa00;
            position: relative;
            transition: all 0.3s;
        }

        .list-section li:hover {
            background-color: rgba(0, 255, 0, 0.1);
            transform: translateX(5px);
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.3);
        }

        .list-section li::before {
            content: "▶";
            color: #00ff00;
            position: absolute;
            left: -10px;
            opacity: 0;
            transition: all 0.3s;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.8);
        }

        .list-section li:hover::before {
            opacity: 1;
            left: -15px;
        }

        /* Стили для футера */
        footer {
            background-color: #001100;
            border-top: 3px solid #00aa00;
            padding: 20px 0;
            margin-top: auto;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.3);
        }

        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                    linear-gradient(45deg, transparent 49%, rgba(0, 255, 0, 0.05) 50%, transparent 51%),
                    linear-gradient(-45deg, transparent 49%, rgba(0, 255, 0, 0.05) 50%, transparent 51%);
            background-size: 10px 10px;
            z-index: 0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .copyright {
            font-size: 14px;
            color: #00aa00;
        }

        .vault-tec-text {
            color: #00ff00;
            font-family: 'Play', sans-serif;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.7);
        }

        .year {
            font-size: 18px;
            color: #00ff00;
            font-weight: bold;
            text-shadow: 0 0 8px rgba(0, 255, 0, 0.8);
        }

        /* Эффект сканирования */
        .scan-line {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to bottom,
            transparent,
            rgba(0, 255, 0, 0.8),
            transparent);
            z-index: 9999;
            pointer-events: none;
            animation: scan 4s linear infinite;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.8);
        }

        @keyframes scan {
            0% { top: 0%; }
            100% { top: 100%; }
        }

        /* Эффект мерцания текста */
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .flicker {
            animation: flicker 3s infinite;
        }

        /* Эффект трубки ЭЛТ */
        .crt-effect::after {
            content: " ";
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: linear-gradient(rgba(0, 255, 0, 0) 50%, rgba(0, 0, 0, 0.25) 50%),
            linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.03));
            background-size: 100% 2px, 3px 100%;
            z-index: 9998;
            pointer-events: none;
        }

        /* Кнопка в стиле Pip-Boy */
        .pip-button {
            background-color: #001a00;
            border: 2px solid #00aa00;
            color: #00ff00;
            font-family: 'Share Tech Mono', monospace;
            padding: 12px 24px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
            margin-top: 10px;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.7);
        }

        .pip-button:hover {
            background-color: rgba(0, 255, 0, 0.1);
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
            transform: translateY(-2px);
        }

        /* Радиокнопки в стиле Pip-Boy */
        .radio-group {
            margin-top: 20px;
        }

        .radio-label {
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .radio-input {
            margin-right: 10px;
            accent-color: #00ff00;
        }

        /* Медиазапросы для адаптивности */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
            }

            .footer-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .panel {
                padding: 15px;
            }

            .logo-text h1 {
                font-size: 22px;
            }
        }

        /* Эффект загрузки/сохранения */
        .save-indicator {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #001100;
            border: 2px solid #00aa00;
            padding: 10px 15px;
            font-size: 12px;
            color: #00ff00;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 10000;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
        }

        .save-indicator.show {
            opacity: 1;
        }
    </style>
</head>
<body class="crt-effect">
<!-- Эффект сканирования -->
<div class="scan-line"></div>

<!-- Хедер -->
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <div class="logo-icon flicker"></div>
                <div class="logo-text">
                    <h1 class="flicker">БУДЬ ДОБРЕЙ</h1>
                    <p>PIP-BOY INTERFACE v2.3.7</p>
                </div>
            </div>
            <div class="phone">
                <div class="phone-label">ЭКСТРЕННАЯ СВЯЗЬ:</div>
                <div class="phone-number flicker">555-01-ВАУЛТ</div>
            </div>
        </div>
    </div>
</header>

<!-- Основное содержимое -->
<main>
    <div class="container">
        <div class="content-wrapper">
            <section class="panel dropdown-section">
                <h2 class="panel-title flicker"><?php echo $game->name?></h2>
                <?php echo $game->text?>
                <div style="margin-top:10px; text-align: center">
                    <a style="text-decoration: none" href="http://<?php echo $_SERVER['HTTP_HOST']?>/frontend/web/<?php echo $game->getGameTypeFrontUrl()?>/new-game?id=<?php echo $game->url?>" class="pip-button" id="confirm-selection">К ИГРЕ</a>
                    <a href = "/" class="pip-button" id="confirm-selection">НАЗАД</a>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Футер -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="copyright">
                <span class="vault-tec-text">VAULT-TEC CORPORATION</span> © <span id="current-year">2077</span>. ВСЕ ПРАВА ЗАЩИЩЕНЫ.
            </div>
            <div class="year flicker" id="dynamic-year">2077</div>
        </div>
    </div>
</footer>

<!-- Индикатор сохранения -->
<div class="save-indicator" id="saveIndicator">СОХРАНЕНИЕ...</div>

<script>
    // Установка текущего года в футере
    document.addEventListener('DOMContentLoaded', function() {
        const currentYear = new Date().getFullYear();
        document.getElementById('current-year').textContent = currentYear;
        document.getElementById('dynamic-year').textContent = currentYear;

        // Добавление эффекта для выпадающего списка
        const selectElement = document.getElementById('city-select');
        selectElement.addEventListener('change', function() {
            if(this.value) {
                // Эффект выбора
                this.style.boxShadow = '0 0 15px rgba(0, 255, 0, 0.7)';
                this.style.backgroundColor = 'rgba(0, 255, 0, 0.1)';
                setTimeout(() => {
                    this.style.boxShadow = '';
                    this.style.backgroundColor = '';
                }, 1000);
            }
        });

        // Эффект для элементов списка
        const listItems = document.querySelectorAll('.list-section li');
        listItems.forEach(item => {
            item.addEventListener('click', function() {
                this.style.backgroundColor = 'rgba(0, 255, 0, 0.2)';
                this.style.boxShadow = '0 0 10px rgba(0, 255, 0, 0.5)';
                setTimeout(() => {
                    this.style.backgroundColor = '';
                    this.style.boxShadow = '';
                }, 500);
            });
        });

        // Эффект для кнопки подтверждения
        const confirmButton = document.getElementById('confirm-selection');
        const saveIndicator = document.getElementById('saveIndicator');

        // confirmButton.addEventListener('click', function() {
        //     const selectedCity = selectElement.options[selectElement.selectedIndex].text;
        //     const priority = document.querySelector('input[name="priority"]:checked').parentElement.textContent.trim();
        //
        //     if (!selectElement.value) {
        //         alert("ВЫБЕРИТЕ ГОРОД ИЗ СПИСКА!");
        //         return;
        //     }
        //
        //     // Эффект нажатия кнопки
        //     this.style.backgroundColor = 'rgba(0, 255, 0, 0.3)';
        //     this.style.boxShadow = '0 0 20px rgba(0, 255, 0, 0.8)';
        //
        //     // Показать индикатор сохранения
        //     saveIndicator.classList.add('show');
        //     saveIndicator.textContent = "СОХРАНЕНИЕ ДАННЫХ...";
        //
        //     // Имитация процесса сохранения
        //     setTimeout(() => {
        //         saveIndicator.textContent = "ДАННЫЕ СОХРАНЕНЫ!";
        //
        //         setTimeout(() => {
        //             saveIndicator.classList.remove('show');
        //             this.style.backgroundColor = '';
        //             this.style.boxShadow = '';
        //
        //             // Показать сообщение о выборе
        //             const message = `ВЫБОР ПОДТВЕРЖДЕН:\n\nГОРОД: ${selectedCity}\nПРИОРИТЕТ: ${priority}\n\nОЖИДАЙТЕ ЗВОНКА ОТ ПРЕДСТАВИТЕЛЯ VAULT-TEC.\n\nСОХРАНЕНИЕ #${Math.floor(Math.random()*1000)} СОЗДАНО.`;
        //             alert(message);
        //         }, 1000);
        //     }, 1500);
        // });

        // Эффект для радиокнопок
        const radioInputs = document.querySelectorAll('.radio-input');
        radioInputs.forEach(radio => {
            radio.addEventListener('change', function() {
                const label = this.parentElement;
                label.style.color = '#00ff00';
                label.style.textShadow = '0 0 8px rgba(0, 255, 0, 0.8)';

                setTimeout(() => {
                    label.style.color = '';
                    label.style.textShadow = '';
                }, 500);
            });
        });

        // Эффект сканирования с случайными интервалами
        const scanLine = document.querySelector('.scan-line');
        function randomizeScan() {
            const randomTime = 3 + Math.random() * 2; // от 3 до 5 секунд
            scanLine.style.animationDuration = `${randomTime}s`;
        }

        setInterval(randomizeScan, 5000);
        randomizeScan();

        // Случайное мерцание элементов с классом flicker
        setInterval(() => {
            const flickerElements = document.querySelectorAll('.flicker');
            flickerElements.forEach(el => {
                if (Math.random() > 0.7) {
                    el.style.opacity = Math.random() * 0.3 + 0.7;
                }
            });
        }, 100);

        // Эффект ЭЛТ-трубки - случайные помехи
        setInterval(() => {
            if (Math.random() > 0.9) {
                document.body.style.filter = `brightness(${Math.random() * 0.2 + 0.9})`;
                setTimeout(() => {
                    document.body.style.filter = '';
                }, 50);
            }
        }, 300);

    });
</script>
</body>
</html>