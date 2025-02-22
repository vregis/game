<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "quest_game_tour".
 *
 * @property int $id
 * @property int $game_id
 * @property int $user_id
 * @property int $tour_id
 * @property int|null $team_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $end_at
 */
class QuestGameTour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quest_game_tour';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_id', 'tour_id'], 'required'],
            [['game_id', 'user_id', 'tour_id', 'team_id'], 'integer'],
            [['created_at', 'updated_at', 'end_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'user_id' => 'User ID',
            'tour_id' => 'Tour ID',
            'team_id' => 'Team ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'end_at' => 'End At',
        ];
    }
}
