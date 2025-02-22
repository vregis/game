<?php

namespace common\models;

use common\models\helpers\Session;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class TeamInvintation extends generated\TeamInvintation
{

    public const NEW_INVITE = 0;
    public const ACCEPTED_INVITE = 1;
    public const CANCELLED_INVITE = 2;

    public string $iUsername;
    public string $iTeamname;


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function issetInvite($teamId, $invitorId, $userId)
    {
        return self::find()->where([
            'team_id' => $teamId,
            'invitor_id' => $invitorId,
            'user_id' => $userId,
            'status' => self::NEW_INVITE
        ])->exists();
    }

    public static function getInviteList($userId)
    {
        return self::find()
            ->select('team_invitation.*, user.username as iUsername, team.name as iTeamname')
            ->join('LEFT JOIN', 'user', 'user.id = team_invitation.invitor_id')
            ->join('LEFT JOIN', 'team', 'team.id = team_invitation.team_id')
            ->where(['user_id' => $userId, 'team_invitation.status' => self::NEW_INVITE])->all();
    }

    public static function getInviteCount()
    {
        return self::find()
            ->where(['user_id' => Session::getUserId(), 'status' => self::NEW_INVITE])
            ->count();
    }

}