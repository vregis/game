<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Убежище Vault-Tec | Pip-Boy Interface</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play&family=Share+Tech+Mono&display=swap" rel="stylesheet">
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon::before {
            content: "♥";
            position: absolute;
            font-family: 'Play', sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #001100;
            text-shadow: 0 0 3px #00ff00;
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
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
            content: "♥";
            color: #00ff00;
            position: absolute;
            left: -10px;
            opacity: 0;
            transition: all 0.3s;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.8);
            font-size: 12px;
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

        .heart-text {
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

        .heart-year {
            animation: heartbeat 1.5s infinite;
            display: inline-block;
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
            position: relative;
            overflow: hidden;
        }

        .pip-button:hover {
            background-color: rgba(0, 255, 0, 0.1);
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
            transform: translateY(-2px);
        }

        .pip-button::after {
            content: "♥";
            position: absolute;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .pip-button:hover::after {
            opacity: 1;
        }

        /* Радиокнопки в стиле Pip-Boy */
        .radio-group {
            margin-top: 20px;
        }

        .radio-label {
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
            position: relative;
            padding-left: 25px;
        }

        .radio-input {
            margin-right: 10px;
            position: absolute;
            left: 0;
            top: 2px;
        }

        .radio-label::after {
            content: "♥";
            position: absolute;
            right: 0;
            opacity: 0;
            transition: opacity 0.3s;
            color: #00ff00;
        }

        .radio-label:hover::after {
            opacity: 0.5;
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

        /* Дополнительные сердечки в дизайне */
        .heart-decoration {
            position: fixed;
            color: rgba(0, 255, 0, 0.1);
            font-size: 24px;
            z-index: -1;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); }
            100% { transform: translateY(-100px) rotate(360deg); }
        }

        /* Статистика здоровья */
        .health-stats {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(0, 26, 0, 0.5);
            border: 1px solid #00aa00;
        }

        .health-bar {
            height: 20px;
            background-color: #001100;
            border: 1px solid #00aa00;
            margin-top: 10px;
            overflow: hidden;
            position: relative;
        }

        .health-fill {
            height: 100%;
            background-color: #00ff00;
            width: 87%;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
            position: relative;
            transition: width 0.5s;
        }

        .health-fill::after {
            content: "♥";
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            color: #001100;
            font-size: 12px;
        }

        .health-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 12px;
            color: #00aa00;
        }
    </style>
</head>
<body class="crt-effect">
<!-- Эффект сканирования -->
<div class="scan-line"></div>

<!-- Декоративные сердечки на фоне -->
<div class="heart-decoration" style="left: 10%; animation-delay: 0s;">♥</div>
<div class="heart-decoration" style="left: 20%; animation-delay: -5s;">♥</div>
<div class="heart-decoration" style="left: 80%; animation-delay: -10s;">♥</div>
<div class="heart-decoration" style="left: 90%; animation-delay: -15s;">♥</div>

<!-- Хедер -->
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <div class="logo-icon"></div>
                <div class="logo-text">
                    <h1 class="flicker">HEART-TEC SYSTEMS</h1>
                    <p>CARDIAC INTERFACE v2.3.7</p>
                </div>
            </div>
            <div class="phone">
                <div class="phone-label">ЭКСТРЕННАЯ СВЯЗЬ:</div>
                <div class="phone-number flicker">555-♥-ВАУЛТ</div>
            </div>
        </div>
    </div>
</header>

<!-- Основное содержимое -->
<main>
    <div class="container">
        <div class="content-wrapper">
            <!-- Выпадающий список с городами -->
            <section class="panel dropdown-section">
                <h2 class="panel-title flicker">♥ ВЫБЕРИТЕ ГОРОД ДЛЯ УБЕЖИЩА ♥</h2>
                <label for="city-select" class="dropdown-label">НАСЕЛЕННЫЙ ПУНКТ ПРОЖИВАНИЯ:</label>
                <select id="city-select" class="fallout-select">
                    <option value="" disabled selected>-- ВЫБЕРИТЕ ГОРОД ИЗ СПИСКА --</option>
                    <option value="wasteland">ПУСТОШЬ (ОСНОВНАЯ ТЕРРИТОРИЯ)</option>
                    <option value="megaton">МЕГАТОННА</option>
                    <option value="rivet-city">РИВЕТ-СИТИ</option>
                    <option value="paradise-falls">РАЙСКИЕ ВОДОПАДЫ</option>
                    <option value="tenpenny">БАШНЯ ТЕНПЕННИ</option>
                    <option value="underworld">ПОДЗЕМКА</option>
                    <option value="canterbury">КЕНТЕРБЕРИЙСКИЕ РУИНЫ</option>
                    <option value="vault-101">УБЕЖИЩЕ 101</option>
                    <option value="vault-108">УБЕЖИЩЕ 108 (ГАРИ?)</option>
                    <option value="new-vegas">НОВАЯ ВЕГАС</option>
                    <option value="diamond-city">ДАЙМОНД-СИТИ</option>
                </select>

                <div class="radio-group">
                    <p style="margin-top: 15px; margin-bottom: 10px; color: #00aa00;">ПРИОРИТЕТ РАЗМЕЩЕНИЯ:</p>
                    <label class="radio-label">
                        <input type="radio" name="priority" class="radio-input" checked>
                        СТАНДАРТНЫЙ (6-8 МЕСЯЦЕВ)
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="priority" class="radio-input">
                        ПОВЫШЕННЫЙ (3-4 МЕСЯЦА) +500 КАПС
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="priority" class="radio-input">
                        СРОЧНЫЙ (1 МЕСЯЦ) +2000 КАПС
                    </label>
                </div>

                <!-- Статистика здоровья -->
                <div class="health-stats">
                    <p style="color: #00ff00; font-size: 14px;"><strong>СТАТУС ЗДОРОВЬЯ СИСТЕМЫ:</strong></p>
                    <div class="health-bar">
                        <div class="health-fill" id="healthFill"></div>
                    </div>
                    <div class="health-labels">
                        <span>КРИТИЧЕСКИЙ</span>
                        <span>СТАБИЛЬНЫЙ</span>
                        <span>ОПТИМАЛЬНЫЙ</span>
                    </div>
                </div>

                <button class="pip-button" id="confirm-selection">ПОДТВЕРДИТЬ ВЫБОР</button>
                <p style="margin-top: 15px; font-size: 14px; color: #00aa00;">
                    ♥ ПОСЛЕ ВЫБОРА ГОРОДА С ВАМИ СВЯЖЕТСЯ ПРЕДСТАВИТЕЛЬ HEART-TEC ДЛЯ ОБСУЖДЕНИЯ ДЕТАЛЕЙ РАЗМЕЩЕНИЯ В УБЕЖИЩЕ.
                </p>
            </section>

            <!-- Обычный список -->
            <section class="panel list-section">
                <h2 class="panel-title flicker">♥ ПРЕИМУЩЕСТВА УБЕЖИЩ HEART-TEC ♥</h2>
                <ul>
                    <li>ЗАЩИТА СЕРДЦА ОТ РАДИАЦИОННОГО ВОЗДЕЙСТВИЯ</li>
                    <li>КАРДИОМОНИТОРИНГ 24/7 ДЛЯ ВСЕХ ЖИТЕЛЕЙ</li>
                    <li>БИОЛОГИЧЕСКИЕ КЛАПАНЫ ДЛЯ УЛУЧШЕНИЯ КРОВООБРАЩЕНИЯ</li>
                    <li>АВТОМАТИЧЕСКИЕ ДЕФИБРИЛЛЯТОРЫ В КАЖДОМ СЕКТОРЕ</li>
                    <li>СИСТЕМА ИСКУССТВЕННОГО КРОВООБРАЩЕНИЯ</li>
                    <li>КАРДИОТРЕНИНГ ДЛЯ ПОДДЕРЖАНИЯ ЗДОРОВЬЯ</li>
                    <li>МОНИТОРИНГ ЭМОЦИОНАЛЬНОГО СОСТОЯНИЯ</li>
                    <li>АВАРИЙНЫЕ ИНЪЕКЦИИ СТИМУЛЯТОРОВ</li>
                    <li>ИНТЕГРАЦИЯ С PIP-BOY CARDIAC MODULE</li>
                    <li>СЕТЬ КАРДИОЛОГИЧЕСКИХ УБЕЖИЩ HEART-TEC</li>
                </ul>

                <div style="margin-top: 20px; padding: 15px; background-color: rgba(0, 26, 0, 0.5); border: 1px solid #00aa00;">
                    <p style="color: #00ff00; font-size: 14px;"><strong>СТАТУС СИСТЕМЫ:</strong> ВСЕ КАРДИОМОДУЛИ ФУНКЦИОНИРУЮТ НОРМАЛЬНО</p>
                    <p style="color: #00aa00; font-size: 12px; margin-top: 5px;">ПОСЛЕДНЕЕ ОБНОВЛЕНИЕ: 23.10.2077 04:17 | ЧСС: <span id="heartRate">72</span> УДАРОВ/МИН</p>
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
                <span class="heart-text">HEART-TEC CARDIAC SYSTEMS</span> © <span id="current-year">2077</span>. ВСЕ ПРАВА ЗАЩИЩЕНЫ.
            </div>
            <div class="year flicker"><span class="heart-year" id="dynamic-year">2077</span> ♥</div>
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

        confirmButton.addEventListener('click', function() {
            const selectedCity = selectElement.options[selectElement.selectedIndex].text;
            const priority = document.querySelector('input[name="priority"]:checked').parentElement.textContent.trim();

            if (!selectElement.value) {
                alert("ВЫБЕРИТЕ ГОРОД ИЗ СПИСКА!");
                return;
            }

            // Эффект нажатия кнопки
            this.style.backgroundColor = 'rgba(0, 255, 0, 0.3)';
            this.style.boxShadow = '0 0 20px rgba(0, 255, 0, 0.8)';

            // Показать индикатор сохранения
            saveIndicator.classList.add('show');
            saveIndicator.textContent = "СОХРАНЕНИЕ ДАННЫХ...";

            // Анимация пульса для здоровья
            const healthFill = document.getElementById('healthFill');
            const heartRateElement = document.getElementById('heartRate');

            // Увеличиваем пульс
            let heartRate = 72;
            const heartRateInterval = setInterval(() => {
                heartRate += 5;
                heartRateElement.textContent = heartRate;

                // Анимация шкалы здоровья
                const pulseWidth = 87 + Math.sin(Date.now() / 200) * 3;
                healthFill.style.width = pulseWidth + '%';
            }, 200);

            // Имитация процесса сохранения
            setTimeout(() => {
                saveIndicator.textContent = "ДАННЫЕ СОХРАНЕНЫ! ♥";

                setTimeout(() => {
                    saveIndicator.classList.remove('show');
                    this.style.backgroundColor = '';
                    this.style.boxShadow = '';
                    clearInterval(heartRateInterval);

                    // Восстанавливаем нормальный пульс
                    heartRateElement.textContent = "72";
                    healthFill.style.width = '87%';

                    // Показать сообщение о выборе
                    const message = `ВЫБОР ПОДТВЕРЖДЕН:\n\nГОРОД: ${selectedCity}\nПРИОРИТЕТ: ${priority}\n\nОЖИДАЙТЕ ЗВОНКА ОТ ПРЕДСТАВИТЕЛЯ HEART-TEC.\n\nСОХРАНЕНИЕ #${Math.floor(Math.random()*1000)} СОЗДАНО.`;
                    alert(message);
                }, 1000);
            }, 1500);
        });

        // Эффект для радиокнопок
        const radioInputs = document.querySelectorAll('.radio-input');
        radioInputs.forEach(radio => {
            radio.addEventListener('change', function() {
                const label = this.parentElement;
                label.style.color = '#00ff00';
                label.style.textShadow = '0 0 8px rgba(0, 255, 0, 0.8)';

                // Пульсация при выборе
                const healthFill = document.getElementById('healthFill');
                healthFill.style.width = '90%';
                setTimeout(() => {
                    healthFill.style.width = '87%';
                }, 300);

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

        // Анимация пульса для шкалы здоровья
        function animateHeartbeat() {
            const healthFill = document.getElementById('healthFill');
            const heartRateElement = document.getElementById('heartRate');

            // Случайное изменение пульса
            let heartRate = 72;
            const baseRate = 72;

            setInterval(() => {
                // Случайные колебания пульса
                const variation = Math.sin(Date.now() / 5000) * 10 + Math.random() * 5;
                heartRate = Math.round(baseRate + variation);
                heartRateElement.textContent = heartRate;

                // Анимация шкалы здоровья в такт пульсу
                const pulse = Math.sin(Date.now() / 500) * 1.5;
                healthFill.style.width = (87 + pulse) + '%';
            }, 500);
        }

        animateHeartbeat();

        // Добавляем больше декоративных сердечек при клике
        document.addEventListener('click', function(e) {
            if (Math.random() > 0.7) {
                const heart = document.createElement('div');
                heart.className = 'heart-decoration';
                heart.textContent = '♥';
                heart.style.left = e.clientX + 'px';
                heart.style.top = e.clientY + 'px';
                heart.style.animationDuration = '3s';
                heart.style.animationIterationCount = '1';
                heart.style.opacity = '0.7';
                heart.style.zIndex = '9997';
                heart.style.fontSize = Math.random() * 20 + 10 + 'px';

                document.body.appendChild(heart);

                // Удаляем сердечко после анимации
                setTimeout(() => {
                    heart.remove();
                }, 3000);
            }
        });
    });
</script>
</body>
</html>