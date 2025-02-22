<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "quest_game_stats".
 *
 * @property int $id
 * @property int $game_id
 * @property int $user_id
 * @property int $question_id
 * @property string|null $answer
 * @property int $is_correct
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $tour_id
 */
class QuestGameStats extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quest_game_stats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_id', 'user_id', 'question_id', 'is_correct', 'tour_id'], 'required'],
            [['game_id', 'user_id', 'question_id', 'is_correct', 'tour_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['answer'], 'string', 'max' => 255],
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
            'question_id' => 'Question ID',
            'answer' => 'Answer',
            'is_correct' => 'Is Correct',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'tour_id' => 'Tour ID',
        ];
    }
}
