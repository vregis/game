<?php

namespace backend\helpers;

use yii\grid\ActionColumn;

class ActionColumnGames extends ActionColumn
{
    public $template = '{question} {update} {delete}';
}