<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property string $text
 * @property int $tour_id
 * @property int $type
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $time
 * @property int $number
 * @property int|null $bonus
 *
 * @property Answers[] $answers
 * @property Prompts[] $prompts
 * @property QuestionsAttachments[] $questionsAttachments
 * @property Tours $tour
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'created_at', 'updated_at', 'number'], 'required'],
            [['text'], 'string'],
            [['tour_id', 'type', 'time', 'number', 'bonus'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tours::class, 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'tour_id' => 'Tour ID',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'time' => 'Time',
            'number' => 'Number',
            'bonus' => 'Bonus',
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Prompts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrompts()
    {
        return $this->hasMany(Prompts::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[QuestionsAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsAttachments()
    {
        return $this->hasMany(QuestionsAttachments::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Tour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tours::class, ['id' => 'tour_id']);
    }
}
