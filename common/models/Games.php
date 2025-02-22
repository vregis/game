<?php

namespace common\models;

use backend\helpers\Constants;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "games".
 *
 * @property int $id
 * @property string $name
 * @property int $game_type
 * @property int $question_type
 * @property int $is_paid
 * @property int $price
 * @property int $created_at
 * @property int $updated_at
 */
class Games extends generated\Games
{

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['game_type', 'question_type', 'is_paid', 'price', 'public', 'time'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'game_type' => 'Тип игры',
            'question_type' => 'Тип вопросов',
            'is_paid' => 'Платная игра',
            'price' => 'Цена',
            'created_at' => 'Создана',
            'updated_at' => 'Обновлена',
            'public' => 'Игра готова',
        ];
    }

    public static function generateRandomString($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function generateStringForGame()
    {
        return self::generateRandomString(6) . time() . self::generateRandomString(6);
    }

    public static function getGameByUrl(string $url): ?Games
    {
        return self::findOne(['url' => $url]);
    }

    public static function getGameById($id): ?Games
    {
        return self::findOne(['id' => $id]);
    }

    public function getGameTypeFrontUrl(): string
    {

        $url = 'unknown';

        if ($this->question_type == 1) {
            $url = 'site';
        } elseif ($this->question_type == 3) {
            $url = 'quest';
        } elseif ($this->question_type == 2) {
            $url = 'storm';
        }

        return $url;
    }
}
