<?php

namespace common\models;

use Yii;
use yii\base\Model;

class FeedbackForm extends Model
{
    public $name;
    public $message;

    public function rules()
    {
        return [
            [['name', 'message'], 'required'],
            ['name', 'string', 'min' => 2, 'max' => 100],
            ['message', 'string', 'min' => 5, 'max' => 5000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'message' => 'Сообщение',
        ];
    }
}