<?php

namespace common\models;

class CityGames extends generated\CityGames
{
    public static function tableName()
    {
        return '{{%city_games}}';
    }

    public function rules()
    {
        return [
            [['city_id', 'game_id'], 'required'],
            [['city_id', 'game_id'], 'integer'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::class, 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function getGame()
    {
        return $this->hasOne(Games::class, ['id' => 'game_id']);
    }
}