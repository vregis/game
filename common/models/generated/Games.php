<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property int $id
 * @property string $name
 * @property int $game_type
 * @property int $question_type
 * @property int $is_paid
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $public
 * @property string|null $url
 * @property int|null $time
 * @property string|null $text
 *
 * @property GameToUser[] $gameToUsers
 * @property QuestGameToUser[] $questGameToUsers
 * @property StormGameToUser[] $stormGameToUsers
 * @property Tours[] $tours
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['game_type', 'question_type', 'is_paid', 'price', 'public', 'time'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['text'], 'string'],
            [['name', 'url'], 'string', 'max' => 255],
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
            'game_type' => 'Game Type',
            'question_type' => 'Question Type',
            'is_paid' => 'Is Paid',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'public' => 'Public',
            'url' => 'Url',
            'time' => 'Time',
            'text' => 'Text',
        ];
    }

    /**
     * Gets query for [[GameToUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameToUsers()
    {
        return $this->hasMany(GameToUser::class, ['game_id' => 'id']);
    }

    /**
     * Gets query for [[QuestGameToUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestGameToUsers()
    {
        return $this->hasMany(QuestGameToUser::class, ['game_id' => 'id']);
    }

    /**
     * Gets query for [[StormGameToUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStormGameToUsers()
    {
        return $this->hasMany(StormGameToUser::class, ['game_id' => 'id']);
    }

    /**
     * Gets query for [[Tours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tours::class, ['game_id' => 'id']);
    }
}
