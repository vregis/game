<?php

namespace common\models;

use common\models\generated\Tours;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use function PHPUnit\Framework\throwException;

class Questions extends generated\Questions
{

    public string $answer;
    public int $sIsCorrect;

    public function behaviors() :array
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
    public function rules(): array
    {
        return [
            [['text', 'number'], 'required'],
            [['tour_id', 'type', 'time', 'number', 'bonus'], 'integer'],
            ['number', 'isNumberExist'],
            [['created_at', 'updated_at'], 'safe'],
            [['text'], 'string'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tours::class, 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    public function isNumberExist($attribute, $params)
    {
        if (!$this->tour_id) {
            $this->addError('number', 'Произошла ошибка');
        }

        if (self::find()->where(['number' => $this->number, 'tour_id' => $this->tour_id])->andWhere(['<>', 'id', $this->id])->exists()) {
            $this->addError('number', 'В данном туре существует вопрос с номером '.$this->number);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'text' => 'Текст вопроса',
            'tour_id' => 'Номер тура',
            'time' => 'Время на вопрос (в секундах)',
            'type' => 'Тип вопроса',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    public static function getQuestionById(int $id): ?Questions
    {
        return self::findOne($id);
    }

    public static function getNextQuestion($questionId)
    {
        $question = self::findOne($questionId);

        if (!$question) {
            throw new NotFoundHttpException('The requested question does not exist.');
        }

        return self::find()->where(['tour_id' => $question->tour_id])->andWhere(['>', 'number', $question->number])->orderBy('number ASC')->one();
    }

    public static function getFirstQuestion($tourId)
    {
        return self::find()->where(['tour_id' => $tourId])->orderBy('number ASC')->one();
    }

    public static function getQuestionsByTourId($tourId): ?array
    {
        return self::find()->where(['tour_id' => $tourId])->orderBy('number ASC')->all();
    }

    public static function getQuestionByTourCount(int $tourId)
    {
        return self::find()->where(['tour_id' => $tourId])->count();
    }

    public static function getQuestionsWithOneAnswer(int $tourId): ?array
    {
        return \Yii::$app->getDb()->createCommand('select questions.id, questions.tour_id, questions.number, questions.text, (select text from answers where questions.id = answers.question_id limit 1) as answer from questions where questions.tour_id = ' . $tourId)->queryAll();

    }
}