<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "quest_game_team_to_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class QuestGameTeamToUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quest_game_team_to_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'game_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        ];
    }
}
