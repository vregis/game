<?php

namespace common\models;

use common\models\generated\Games;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Tours extends generated\Tours
{

    public function rules()
    {
        return [
            [['name', 'number'], 'required'],
            ['number', 'isNumberExist'],
            [['number', 'game_id', 'type', 'is_perforate', 'bonus'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'time'], 'string', 'max' => 255],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::class, 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    public function behaviors() :array
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

    public function isNumberExist($attribute, $params)
    {
        if (!$this->game_id) {
            $this->addError('number', 'Произошла ошибка');
        }

        if (self::find()->where(['number' => $this->number, 'game_id' => $this->game_id])->andWhere(['<>', 'id', $this->id])->exists()) {
            $this->addError('number', 'В данной игре существует тур с номером '.$this->number);
        }
    }

    public static function getNextTour(int $gameId, int $prevTour = 0)
    {
        return self::find()->where(['game_id' => $gameId])->andWhere(['>', 'number', $prevTour])->orderBy('number ASC')->one();
    }

    public static function getTourById(int $tourId)
    {
        return self::find()->where(['id' => $tourId])->one();
    }

    public static function getToursByGameId(int $gameId)
    {
        return self::find()->where(['game_id' => $gameId])->orderBy('number ASC')->all();
    }

    public function attributeLabels() :array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'number' => 'Номер',
            'game_id' => 'Игра',
            'type' => 'Тип',
            'is_perforate' => 'Сквозной',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }
}