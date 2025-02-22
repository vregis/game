<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "team_invitation".
 *
 * @property int $id
 * @property int $team_id
 * @property int $invitor_id
 * @property int $user_id
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TeamInvintation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_invitation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id', 'invitor_id', 'user_id'], 'required'],
            [['team_id', 'invitor_id', 'user_id', 'status'], 'integer'],
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
            'invitor_id' => 'Invitor ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
