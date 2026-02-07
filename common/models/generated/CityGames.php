<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "city_games".
 *
 * @property int $city_id
 * @property int $game_id
 *
 * @property City $city
 * @property Games $game
 */
class CityGames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city_games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'game_id'], 'required'],
            [['city_id', 'game_id'], 'integer'],
            [['city_id', 'game_id'], 'unique', 'targetAttribute' => ['city_id', 'game_id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::class, 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'game_id' => 'Game ID',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Game]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Games::class, ['id' => 'game_id']);
    }

    public static function addLink($gameId, $cities) {
        $exist = CityGames::find()->where(['game_id' => $gameId])->all();
        if ($exist) {
            foreach ($exist as $item) {
                $item->delete();
            }
        }

        if (is_array($cities)) {
            foreach ($cities as $city) {
                $model = new CityGames();
                $model->game_id = $gameId;
                $model->city_id = $city;
                $model->save();
            }
        }


    }
}
