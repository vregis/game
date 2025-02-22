<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "tours".
 *
 * @property int $id
 * @property string $name
 * @property int $number
 * @property int $game_id
 * @property int $type
 * @property int|null $is_perforate
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $time
 * @property int|null $bonus
 *
 * @property Games $game
 * @property Questions[] $questions
 */
class Tours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['number', 'game_id', 'type', 'is_perforate', 'bonus'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'time'], 'string', 'max' => 255],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::class, 'targetAttribute' => ['game_id' => 'id']],
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
            'number' => 'Number',
            'game_id' => 'Game ID',
            'type' => 'Type',
            'is_perforate' => 'Is Perforate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'time' => 'Time',
            'bonus' => 'Bonus',
        ];
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

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::class, ['tour_id' => 'id']);
    }
}
