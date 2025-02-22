<?php

namespace common\models;

use common\models\generated\Questions;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Prompts extends generated\Prompts
{
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

    public function rules()
    {
        return [
            [['number', 'question_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'text'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::class, 'targetAttribute' => ['question_id' => 'id']],
        ];
    }
}