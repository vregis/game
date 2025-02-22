<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "storm_game_to_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $team_id
 * @property int $game_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Games $game
 */
class StormGameToUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'storm_game_to_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'team_id', 'game_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'team_id' => 'Team ID',
            'game_id' => 'Game ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
