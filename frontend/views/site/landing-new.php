<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список городов</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(145deg, #2563eb, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 22px;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            flex-shrink: 0;
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

        .phone {
            background: #f1f5f9;
            padding: 10px 20px;
            border-radius: 12px;
            text-align: right;
        }

        .phone-label {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .phone-number {
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: 0.5px;
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
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 20px;
            letter-spacing: -0.2px;
        }

        .panel-title span {
            color: #2563eb;
        }

        /* ===== ВЫПАДАЮЩИЙ СПИСОК ===== */
        .dropdown-section {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .dropdown-label {
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 4px;
        }

        .fallout-select {
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            color: #0f172a;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            padding: 12px 16px;
            width: 100%;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            transition: all 0.2s;
            font-weight: 400;
        }

        .fallout-select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
            background-color: #ffffff;
        }

        .fallout-select option {
            padding: 8px;
            background: #ffffff;
            color: #0f172a;
        }

        .panel .info-text {
            margin-top: 16px;
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
            padding: 16px 20px;
            background: #f8fafc;
            border-radius: 12px;
            border-left: 3px solid #2563eb;
        }

        /* ===== СПИСОК ИГР ===== */
        .list-section ul {
            list-style: none;
            padding: 0;
        }

        .list-section li {
            padding: 14px 18px;
            margin-bottom: 8px;
            background: #f8fafc;
            border-radius: 12px;
            border-left: 3px solid #2563eb;
            transition: all 0.2s;
            font-weight: 500;
            color: #0f172a;
            font-size: 15px;
        }

        .list-section li:hover {
            background: #eff6ff;
            transform: translateX(4px);
            border-left-color: #1d4ed8;
        }

        .status-block {
            margin-top: 24px;
            padding: 18px 22px;
            background: #f1f5f9;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .status-block p {
            font-size: 14px;
            color: #334155;
        }

        .status-block p strong {
            color: #0f172a;
            font-weight: 600;
        }

        .status-block .small {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 6px;
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
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
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

            .phone {
                text-align: center;
            }

            .panel {
                padding: 20px 18px;
            }

            .content-wrapper {
                padding: 0 4px;
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
                <!-- Логотип -->
                <div class="login-logo">
                    <img src="/uploads/logo.png" alt="Логотип">
                </div>
                <div class="logo-text">
                    <h1>Забава</h1>
                    <p>Система управления городами</p>
                </div>
            </div>
            <div class="phone">
                <div class="phone-label">Служба поддержки</div>
                <div class="phone-number">911</div>
            </div>
        </div>
    </div>
</header>

<!-- ===== ОСНОВНОЙ КОНТЕНТ ===== -->
<main>
    <div class="container">
        <div class="content-wrapper">

            <!-- ВЫБОР ГОРОДА -->
            <section class="panel dropdown-section">
                <h2 class="panel-title">Добро пожаловать</h2>
                <label for="city-select" class="dropdown-label">Выберите город</label>
                <select id="city-select" data-url="<?= \yii\helpers\Url::to(['/site/change-city']) ?>" class="fallout-select">
                    <?php if (!$city): ?>
                        <option value="" disabled selected>— Выберите город из списка —</option>
                    <?php else: ?>
                        <?php foreach ($city as $c): ?>
                            <option value="<?= $c->id ?>"><?= $c->name ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <div class="info-text">
                    После выбора города с вами свяжется представитель для обсуждения деталей.
                </div>
            </section>

            <!-- СПИСОК ИГР -->
            <section class="panel list-section">
                <h2 class="panel-title">Доступные игры в городе <span class="current_city"></span></h2>
                <ul class="game_list">
                    <li>Защита от ядерных, биологических и химических угроз</li>
                </ul>

                <div class="status-block">
                    <p><strong>Забава:</strong> Приключения в реальности</p>
                </div>
            </section>

        </div>
    </div>
</main>

<!-- ===== ФУТЕР ===== -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="copyright">
                <strong></strong> © <span id="current-year">2077</span>. Все права защищены.
            </div>
            <div class="year" id="dynamic-year">2077</div>
        </div>
    </div>
</footer>

<!-- ===== JS ===== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Год в футере
        const year = new Date().getFullYear();
        document.getElementById('current-year').textContent = year;
        document.getElementById('dynamic-year').textContent = year;

        const select = document.getElementById('city-select');

        // AJAX при смене города
        $(document).on('change', '.fallout-select', function(){
            const val = $(this).val();
            if (!val) return;

            $.ajax({
                type: 'POST',
                data: { id: val },
                url: $(this).attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true) {
                        $('.game_list').html(msg.content);
                        // обновим название города в заголовке
                        const cityName = $('.fallout-select option:selected').text();
                        $('.current_city').text(cityName);
                    } else {
                        alert('Произошла ошибка');
                    }
                },
                error: function() {
                    alert('Ошибка соединения с сервером');
                }
            });
        });

        // Первоначальная загрузка, если город уже выбран
        const initialVal = $('.fallout-select').val();
        if (initialVal) {
            $.ajax({
                type: 'POST',
                data: { id: initialVal },
                url: $('.fallout-select').attr('data-url'),
                dataType: 'json',
                success: function(msg){
                    if (msg.success == true) {
                        $('.game_list').html(msg.content);
                        const cityName = $('.fallout-select option:selected').text();
                        $('.current_city').text(cityName);
                    }
                }
            });
        }

        // Приятный эффект при выборе
        select.addEventListener('change', function() {
            if (this.value) {
                this.style.borderColor = '#2563eb';
                setTimeout(() => {
                    this.style.borderColor = '#e2e8f0';
                }, 800);
            }
        });

    });
</script>

</body>
</html>