<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 *
 * @property CityGames[] $cityGames
 * @property Games[] $games
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[CityGames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCityGames()
    {
        return $this->hasMany(CityGames::class, ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Games]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::class, ['id' => 'game_id'])->viaTable('city_games', ['city_id' => 'id']);
    }
}
