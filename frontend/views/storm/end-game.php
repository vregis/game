<table class="table table-bordered">
    <thead>
    <th style="width:20%">Название команды</th>
    <th style="width:20%">Время</th>
    </thead>
    <tbody>
    <?php usort($gameResults, function ($x, $y) {
        $diffX = strtotime($x->start_at) - strtotime($x->end_at);
        $diffY = strtotime($y->start_at) - strtotime($y->end_at);

        return $diffY <=> $diffX;
    }) ?>
    <?php foreach ($gameResults as $gameResult):?>
        <tr>
            <td><?php echo $gameResult->userName?></td>
            <td><?php echo \common\models\StormGameToUser::calculateTime($gameResult->start_at, $gameResult->end_at)?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseOne">
                    Открыть результаты команды
                </button>
            </h2>
        </div>

        <div id="collapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <?php foreach ($tourList as $tour): ?>
                    <table class="table table-bordered">
                        <thead>
                        <th style="width:20%">Номер вопроса</th>
                        <th style="width:20%">Текст вопроса</th>
                        <th style="width:20%">Верный ответ</th>
                        <th style="width:20%">Результат</th>
                        </thead>
                        <tbody>
                        <?php $questions = \common\models\Questions::getQuestionsWithOneAnswer($tour->id);?>
                        <?php foreach ($questions as $q):?>
                            <tr>
                                <td><?php echo $q['number']?></td>
                                <td><?php echo $q['text']?></td>
                                <td><?php echo $q['answer']?></td>
                                <td><?php echo in_array($q['id'], $correctAnswers) ? 'Верно' : 'Не верно'?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
