<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "quest_game_to_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $end_at
 * @property int|null $bonus
 *
 * @property Games $game
 * @property Games $game0
 */
class QuestGameToUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quest_game_to_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'game_id', 'bonus'], 'integer'],
            [['created_at', 'updated_at', 'end_at'], 'safe'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::class, 'targetAttribute' => ['game_id' => 'id']],
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
            'user_id' => 'User ID',
            'game_id' => 'Game ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'end_at' => 'End At',
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
     * Gets query for [[Game0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGame0()
    {
        return $this->hasOne(Games::class, ['id' => 'game_id']);
    }
}
