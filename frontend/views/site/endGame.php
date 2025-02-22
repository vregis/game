<p>Игра завершена</p>
<p>Результаты игры</p>
<?php if ($toursList):?>
    <?php $totalPts = 0;?>
    <?php foreach ($toursList as $tour):?>
        <h3>Результаты тура "<?php echo $tour?>"</h3>
        <table class="table table-bordered">
            <thead>
            <th style="width:20%">Номер вопроса</th>
            <th style="width:20%">Текст вопроса</th>
            <th style="width:20%">Ваш Ответ</th>
            <th style="width:20%">Верный ответ</th>
            <th style="width:20%">Результат</th>
            </thead>
            <?php $tourPts = 0;?>
            <?php foreach ($stat as $s):?>
                <?php if ($s->tId == $tour):?>
                    <tr>
                        <td><?php echo $s->number?></td>
                        <td><?php echo $s->text?></td>
                        <td><?php echo $s->answer?></td>
                        <td>
                            <?php if ($answers = \common\models\Answers::getAnswersByQuestionId($s->qId)):?>
                                <?php echo $answers[0]->text;?>
                                <?php unset($answers[0])?>
                                <?php $i = 0;?>
                                (
                                <?php foreach ($answers as $answer):?>
                                    <?php echo $answer->text?>,&nbsp
                                <?php endforeach;?>
                                )
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if ($s->is_correct):?>
                                <?php $tourPts++;?>
                                <?php $totalPts++;?>
                                <span style="color:green">Верно</span>
                            <?php else:?>
                                <span style="color:red">Неверно</span>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endif;?>
            <?php endforeach;?>
        </table>
        <p><b>НАБРАНО: <?php echo $tourPts?> очков</b></p>
    <?php endforeach;?>
    <p><b>Всего набрано <?php echo $totalPts?></b></p>
<?php endif;?>