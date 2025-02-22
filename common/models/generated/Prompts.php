<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "prompts".
 *
 * @property int $id
 * @property string|null $name
 * @property int $number
 * @property int $question_id
 * @property string|null $text
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $time
 *
 * @property PromptsAttachments[] $promptsAttachments
 * @property Questions $question
 */
class Prompts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prompts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'question_id', 'time'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'text'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::class, 'targetAttribute' => ['question_id' => 'id']],
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
            'question_id' => 'Question ID',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'time' => 'Time',
        ];
    }

    /**
     * Gets query for [[PromptsAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPromptsAttachments()
    {
        return $this->hasMany(PromptsAttachments::class, ['prompt_id' => 'id']);
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::class, ['id' => 'question_id']);
    }
}
