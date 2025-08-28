
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гастрономический Квиз с Пчелками</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #fff8e1, #ffecb3);
            min-height: 100vh;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            position: relative;
            overflow-x: hidden!important;
        }

        .header {
            background: linear-gradient(to right, #ffc107, #ff9800);
            border-radius: 0 0 50% 50% / 30%;
            padding: 2rem 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .quiz-container {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .btn-start {
            background: linear-gradient(to right, #ffeb3b, #ffc107);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #5d4037;
            box-shadow: 0 8px 15px rgba(255, 193, 7, 0.4);
            transition: all 0.3s ease;
            margin: 2rem 0;
        }

        .btn-start:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(255, 193, 7, 0.5);
        }

        .bee {
            position: absolute;
            width: 40px;
            height: 40px;
            z-index: 1;
        }

        .bee-body {
            width: 100%;
            height: 100%;
            background: #ffeb3b;
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }

        .bee-stripe {
            position: absolute;
            width: 100%;
            height: 8px;
            background: #5d4037;
            top: 50%;
            transform: translateY(-50%);
        }

        .bee-wing {
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50% 50% 0 50%;
            top: 5px;
            right: -5px;
            animation: wingFlap 0.3s infinite alternate;
        }

        .bee-wing:nth-child(2) {
            top: 25px;
            right: -5px;
            border-radius: 50% 0 50% 50%;
        }

        @keyframes wingFlap {
            from { transform: rotate(10deg); }
            to { transform: rotate(-10deg); }
        }

        .question-container {
            display: none;
        }

        .options-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .option-btn {
            background: #f5f5f5;
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 1rem;
            text-align: left;
            transition: all 0.2s ease;
            font-size: 1rem;
        }

        .option-btn:hover {
            background: #fff8e1;
            transform: translateY(-3px);
        }

        .option-btn.correct {
            background: #c8e6c9;
            border-color: #4caf50;
        }

        .option-btn.incorrect {
            background: #ffcdd2;
            border-color: #f44336;
        }

        .honey-comb {
            position: absolute;
            width: 100px;
            height: 87px;
            background: linear-gradient(to bottom, #ffd54f, #ffb300);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            opacity: 0.3;
            z-index: 0;
        }

        .score-container {
            font-size: 1.2rem;
            font-weight: bold;
            color: #5d4037;
            margin-bottom: 1rem;
        }

        .progress {
            height: 10px;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            background-color: #fff8e1;
        }

        .progress-bar {
            background: linear-gradient(to right, #ffeb3b, #ffc107);
        }

        .result-container {
            text-align: center;
            display: none;
        }

        .result-title {
            color: #ff9800;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .result-score {
            font-size: 3rem;
            color: #5d4037;
            margin-bottom: 2rem;
        }

        .bee-flying {
            animation: flyAround 15s linear infinite;
        }

        @keyframes flyAround {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(200px, 150px) rotate(90deg); }
            50% { transform: translate(400px, 0) rotate(180deg); }
            75% { transform: translate(200px, -150px) rotate(270deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }
    </style>
</head>
<body>
<!-- Пчелки -->
<div class="bee bee-flying" style="top: 20%; left: 10%; animation-duration: 20s;">
    <div class="bee-body">
        <div class="bee-stripe"></div>
        <div class="bee-wing"></div>
        <div class="bee-wing"></div>
    </div>
</div>

<div class="bee bee-flying" style="top: 70%; left: 20%; animation-duration: 25s; animation-delay: -5s;">
    <div class="bee-body">
        <div class="bee-stripe"></div>
        <div class="bee-wing"></div>
        <div class="bee-wing"></div>
    </div>
</div>

<div class="bee bee-flying" style="top: 40%; left: 80%; animation-duration: 18s; animation-delay: -7s;">
    <div class="bee-body">
        <div class="bee-stripe"></div>
        <div class="bee-wing"></div>
        <div class="bee-wing"></div>
    </div>
</div>

<!-- Соты -->
<div class="honey-comb" style="top: 10%; left: 5%;"></div>
<div class="honey-comb" style="top: 15%; left: 15%; transform: scale(0.8);"></div>
<div class="honey-comb" style="top: 80%; left: 80%; transform: scale(1.2);"></div>
<div class="honey-comb" style="top: 70%; left: 70%; transform: scale(0.7);"></div>
<div class="honey-comb" style="top: 20%; left: 85%; transform: scale(0.9);"></div>

<div class="container py-5">
    <div class="header text-center">
        <h1 class="display-4 fw-bold text-white">Гастрономический квест</h1>
    </div>

    <div class="quiz-container text-center">
        <div id="start-container">
            <h2 class="mb-4" style="color: #ff9800;">Готовы к вкусной викторине?</h2>
            <p class="mb-4">Ответьте на вопросы о продуктах питания, кухнях мира и гастрономических фактах.</p>
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='72' height='72'%3E%3Cpath fill='%23ffc107' d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z'/%3E%3C/svg%3E" alt="Пчелка" class="mb-3">
            <div class="row">
                <?php $exist = \common\models\StormGameToUser::find()->where(['user_id' => Yii::$app->user->getId(), 'game_id' => 15])->one(); ?>
                <?php if ($exist && Yii::$app->user->id != 2):?>
                    <p>Данный пользователь уже участвует в игре</p>
                <?php else: ?>
                    <h1><a class="btn btn-start" href="/frontend/web/storm/new-game?id=Uky3fq17564141086DOwJX">Начать игру</a></h1>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {





        // Добавляем дополнительные летающие пчелки через JavaScript
        function createBee() {
            const bee = document.createElement('div');
            bee.classList.add('bee', 'bee-flying');

            const beeBody = document.createElement('div');
            beeBody.classList.add('bee-body');

            const stripe = document.createElement('div');
            stripe.classList.add('bee-stripe');

            const wing1 = document.createElement('div');
            wing1.classList.add('bee-wing');

            const wing2 = document.createElement('div');
            wing2.classList.add('bee-wing');

            beeBody.appendChild(stripe);
            beeBody.appendChild(wing1);
            beeBody.appendChild(wing2);
            bee.appendChild(beeBody);

            // Случайное положение и скорость анимации
            const top = Math.random() * 80 + 10;
            const left = Math.random() * 80 + 10;
            const duration = Math.random() * 15 + 10;
            const delay = Math.random() * -10;

            bee.style.top = `${top}%`;
            bee.style.left = `${left}%`;
            bee.style.animationDuration = `${duration}s`;
            bee.style.animationDelay = `${delay}s`;

            document.body.appendChild(bee);
        }

        // Создаем несколько пчелок
        for (let i = 0; i < 5; i++) {
            createBee();
        }
    });
</script>
</body>
</html>