<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property int $creator_id
 * @property int $captain_id
 * @property string|null $name
 * @property string|null $avatar
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'captain_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creator_id' => 'Creator ID',
            'captain_id' => 'Captain ID',
            'name' => 'Name',
            'avatar' => 'Avatar',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
