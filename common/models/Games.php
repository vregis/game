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
 * @property City[] $cities
 */
class Games extends generated\Games
{

    protected $cities;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['game_type', 'question_type', 'is_paid', 'price', 'public', 'time'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url', 'text'], 'string'],
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
        } elseif ($this->question_type == 3 && $this->game_type == 1) {
            $url = 'quest';
        } elseif ($this->question_type == 3 && $this->game_type == 2) {
            $url = 'quest-team';
        } elseif ($this->question_type == 2) {
            $url = 'storm';
        }

        return $url;
    }

    /**
     * Связь с городами через промежуточную таблицу
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['id' => 'city_id'])
            ->viaTable('{{%city_games}}', ['game_id' => 'id']);
    }

    /**
     * Получить все города с сортировкой (опционально)
     */
    public function getCitiesSorted()
    {
        return $this->hasMany(City::class, ['id' => 'city_id'])
            ->viaTable('{{%city_games}}', ['game_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }


    public static function dateDifference($date1, $date2, $format = 'array') {
        // Создаем объекты DateTime
        $datetime1 = \DateTime::createFromFormat('Y-m-d H:i:s', $date1);
        $datetime2 = \DateTime::createFromFormat('Y-m-d H:i:s', $date2);

        // Проверяем валидность дат
        if (!$datetime1 || !$datetime2) {
            return false;
        }

        // Вычисляем разницу
        $interval = $datetime1->diff($datetime2);

        // Форматируем результат в зависимости от параметра
        switch ($format) {
            case 'array':
                return [
                    'years'   => $interval->y,
                    'months'  => $interval->m,
                    'days'    => $interval->d,
                    'hours'   => $interval->h,
                    'minutes' => $interval->i,
                    'seconds' => $interval->s,
                    'total_days' => $interval->days,
                    'invert'  => $interval->invert, // 1 если date2 > date1
                    'sign'    => $interval->invert ? '-' : '+'
                ];

            case 'string':
                $sign = $interval->invert ? 'минус ' : '';
                return $sign . $interval->y . ' лет, ' .
                    $interval->m . ' месяцев, ' .
                    $interval->d . ' дней, ' .
                    $interval->h . ' часов, ' .
                    $interval->i . ' минут, ' .
                    $interval->s . ' секунд';

            case 'seconds':
                return abs(strtotime($date2) - strtotime($date1));

            case 'minutes':
                return abs(strtotime($date2) - strtotime($date1)) / 60;

            case 'hours':
                return abs(strtotime($date2) - strtotime($date1)) / 3600;

            case 'days':
                return $interval->days;

            default:
                return $interval;
        }
    }
}
