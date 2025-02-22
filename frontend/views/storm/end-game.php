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