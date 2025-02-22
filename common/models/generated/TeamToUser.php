<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "team_to_user".
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TeamToUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_to_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id', 'user_id'], 'required'],
            [['team_id', 'user_id'], 'integer'],
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
            'team_id' => 'Team ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
