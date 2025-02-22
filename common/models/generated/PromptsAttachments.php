<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "prompts_attachments".
 *
 * @property int $id
 * @property int $prompt_id
 * @property int $type
 * @property string|null $url
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Prompts $prompt
 */
class PromptsAttachments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prompts_attachments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prompt_id', 'type'], 'integer'],
            [['url'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['prompt_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prompts::class, 'targetAttribute' => ['prompt_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prompt_id' => 'Prompt ID',
            'type' => 'Type',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Prompt]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrompt()
    {
        return $this->hasOne(Prompts::class, ['id' => 'prompt_id']);
    }
}
