<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Убежище Vault-Tec</title>
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
            background-color: #1a1a1a;
            color: #c0c0c0;
            background-image:
                    radial-gradient(circle at 10% 20%, rgba(40, 60, 20, 0.1) 0%, transparent 20%),
                    radial-gradient(circle at 90% 80%, rgba(60, 40, 20, 0.1) 0%, transparent 20%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Стили для хедера */
        header {
            background-color: #0a0a0a;
            border-bottom: 3px solid #8b8000;
            padding: 15px 0;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                    linear-gradient(90deg, transparent 50%, rgba(139, 128, 0, 0.05) 50%),
                    linear-gradient(rgba(139, 128, 0, 0.05) 50%, transparent 50%);
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
            background: radial-gradient(circle, #8b8000 30%, #5a5000 70%);
            border-radius: 50%;
            position: relative;
            border: 2px solid #c0c0c0;
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
            color: #0a0a0a;
        }

        .logo-text h1 {
            font-family: 'Play', sans-serif;
            font-size: 28px;
            color: #8b8000;
            text-shadow: 0 0 5px rgba(139, 128, 0, 0.5);
            letter-spacing: 1px;
        }

        .logo-text p {
            font-size: 12px;
            color: #808080;
            margin-top: 3px;
        }

        .phone {
            background-color: #1a1a1a;
            padding: 10px 20px;
            border: 2px solid #8b8000;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(139, 128, 0, 0.3);
        }

        .phone-label {
            font-size: 12px;
            color: #808080;
            margin-bottom: 5px;
        }

        .phone-number {
            font-family: 'Play', sans-serif;
            font-size: 22px;
            color: #8b8000;
            letter-spacing: 1px;
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
            background-color: rgba(10, 10, 10, 0.8);
            border: 2px solid #8b8000;
            padding: 25px;
            position: relative;
            box-shadow: 0 0 15px rgba(139, 128, 0, 0.2);
        }

        .panel::before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 1px solid rgba(139, 128, 0, 0.3);
            pointer-events: none;
        }

        .panel-title {
            font-family: 'Play', sans-serif;
            color: #8b8000;
            font-size: 22px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #8b8000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Стили для выпадающего списка */
        .dropdown-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .dropdown-label {
            font-size: 16px;
            color: #c0c0c0;
        }

        .fallout-select {
            background-color: #1a1a1a;
            border: 2px solid #8b8000;
            color: #8b8000;
            font-family: 'Share Tech Mono', monospace;
            font-size: 16px;
            padding: 10px 15px;
            width: 100%;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%238b8000' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            transition: all 0.3s;
        }

        .fallout-select:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(139, 128, 0, 0.5);
        }

        .fallout-select option {
            background-color: #1a1a1a;
            color: #8b8000;
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
            background-color: rgba(26, 26, 26, 0.7);
            border-left: 3px solid #8b8000;
            position: relative;
            transition: all 0.3s;
        }

        .list-section li:hover {
            background-color: rgba(139, 128, 0, 0.1);
            transform: translateX(5px);
        }

        .list-section li::before {
            content: "▶";
            color: #8b8000;
            position: absolute;
            left: -10px;
            opacity: 0;
            transition: all 0.3s;
        }

        .list-section li:hover::before {
            opacity: 1;
            left: -15px;
        }

        /* Стили для футера */
        footer {
            background-color: #0a0a0a;
            border-top: 3px solid #8b8000;
            padding: 20px 0;
            margin-top: auto;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                    linear-gradient(45deg, transparent 49%, rgba(139, 128, 0, 0.05) 50%, transparent 51%),
                    linear-gradient(-45deg, transparent 49%, rgba(139, 128, 0, 0.05) 50%, transparent 51%);
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
            color: #808080;
        }

        .vault-tec-text {
            color: #8b8000;
            font-family: 'Play', sans-serif;
        }

        .year {
            font-size: 18px;
            color: #8b8000;
            font-weight: bold;
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
            rgba(139, 128, 0, 0.6),
            transparent);
            z-index: 9999;
            pointer-events: none;
            animation: scan 4s linear infinite;
        }

        @keyframes scan {
            0% { top: 0%; }
            100% { top: 100%; }
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
        }
    </style>
</head>
<body>
<!-- Эффект сканирования -->
<div class="scan-line"></div>

<!-- Хедер -->
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <div class="logo-icon"></div>
                <div class="logo-text">
                    <h1>VAULT-TEC CORPORATION</h1>
                    <p>Создаём будущее под землёй</p>
                </div>
            </div>
            <div class="phone">
                <div class="phone-label">Экстренная связь:</div>
                <div class="phone-number">555-01-ВАУЛТ</div>
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
                <h2 class="panel-title">Выберите город для убежища</h2>
                <label for="city-select" class="dropdown-label">Населенный пункт проживания:</label>
                <select id="city-select" class="fallout-select">
                    <option value="" disabled selected>-- Выберите город из списка --</option>
                    <option value="wasteland">Пустошь (основная территория)</option>
                    <option value="megaton">Мегатонна</option>
                    <option value="rivet-city">Ривет-Сити</option>
                    <option value="paradise-falls">Райские Водопады</option>
                    <option value="tenpenny">Башня Тенпенни</option>
                    <option value="underworld">Подземка</option>
                    <option value="canterbury">Кентерберийские руины</option>
                    <option value="vault-101">Убежище 101</option>
                    <option value="vault-108">Убежище 108</option>
                </select>
                <p style="margin-top: 15px; font-size: 14px; color: #808080;">
                    После выбора города с вами свяжется представитель Vault-Tec для обсуждения деталей размещения в убежище.
                </p>
            </section>

            <!-- Обычный список -->
            <section class="panel list-section">
                <h2 class="panel-title">Преимущества убежищ Vault-Tec</h2>
                <ul>
                    <li>Защита от ядерных, биологических и химических угроз</li>
                    <li>Автономные системы жизнеобеспечения на 200+ лет</li>
                    <li>Генетические банки для восстановления флоры и фауны</li>
                    <li>Образовательные и развлекательные программы</li>
                    <li>Экспериментальные технологии для улучшения человечества</li>
                    <li>Системы рециркуляции воздуха и воды</li>
                    <li>Защищённые коммуникационные каналы</li>
                    <li>Медицинские модули с автоматическими докторами</li>
                </ul>
            </section>
        </div>
    </div>
</main>

<!-- Футер -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="copyright">
                <span class="vault-tec-text">Vault-Tec Corporation</span> © <span id="current-year">2077</span>. Все права защищены.
            </div>
            <div class="year" id="dynamic-year">2077</div>
        </div>
    </div>
</footer>

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
                this.style.boxShadow = '0 0 15px rgba(139, 128, 0, 0.7)';
                setTimeout(() => {
                    this.style.boxShadow = '';
                }, 500);

                // Показать сообщение о выборе
                const message = `Вы выбрали: ${this.options[this.selectedIndex].text}. Ожидайте звонка от представителя Vault-Tec.`;
                alert(message);
            }
        });

        // Эффект для элементов списка
        const listItems = document.querySelectorAll('.list-section li');
        listItems.forEach(item => {
            item.addEventListener('click', function() {
                this.style.backgroundColor = 'rgba(139, 128, 0, 0.2)';
                setTimeout(() => {
                    this.style.backgroundColor = '';
                }, 300);
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
    });
</script>
</body>
</html>