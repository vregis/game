<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class TeamToUser extends generated\TeamToUser
{
    public $teamName;
    public $uName;
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}