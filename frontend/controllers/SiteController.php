<?php

namespace frontend\controllers;

use common\models\Answers;
use common\models\Games;
use common\models\GameToUser;
use common\models\helpers\Session;
use common\models\LineGameStats;
use common\models\Questions;
use common\models\Tours;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Symfony\Component\Console\Question\Question;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->layout = 'login';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'about', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','logout', 'about', 'question'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('pip-start');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = false;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login-pip', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @param $id
     * @return void
     * @throws NotFoundHttpException
     */
    public function actionQuestion($id): string
    {

        $question = Questions::findOne($id);

        if (!$question) {
            throw new NotFoundHttpException('The requested question does not exist.');
        }

        $attachments = $question->getQuestionsAttachments()->all();

        return $this->render('question', ['question' => $question, 'attachments' => $attachments]);
    }

    public function actionNextQuestion()
    {
        if (empty($_POST['id']) || empty($_POST['tour_id'])) {
            $response['success'] = false;
            $response['msg'] = 'Произошла ошибка, обратитесь к администратору';
            return json_encode($response);
        }

        Answers::checkAnswer($_POST['id'], $_POST['answer']);

        $response['success'] = true;

        if ($nextQuestion = Questions::getNextQuestion($_POST['id'])) {
            $response['url'] = $_SERVER["HTTP_ORIGIN"] . \yii\helpers\Url::to(['/site/question', 'id' => $nextQuestion->id]);
        } else {
            $response['url'] = $_SERVER["HTTP_ORIGIN"] .  \yii\helpers\Url::to(['/site/end-tour', 'id' => $_POST['tour_id']]);
        }

        return json_encode($response);
    }

    public function actionEndTour($id): string
    {
        $tour = Tours::findOne($id);
        $stat = LineGameStats::getTourStatistic($id);

        return $this->render('endTour', ['tour' => $tour, 'stat' => $stat]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionNewGame($id): string
    {
        $game = Games::getGameByUrl($id);

        if (!$game) {
            throw new NotFoundHttpException('Игры не существует');
        }

        return $this->render('game', ['game' => $game]);
    }

    public function actionGameStart()
    {
        $response['success'] = false;
        if (empty($_POST['id'])) {
            return json_encode($response);
        }

        $game = Games::getGameById($_POST['id']);

        if (!$game) {
            return json_encode($response);
        }

        $tour = Tours::getNextTour($game->id);

        if (!$tour) {
            return json_encode($response);
        }

        GameToUser::startGame($game->id);


        $response['success'] = true;
        $response['url'] = Url::to(['/site/tour', 'id' => $tour->id]);

        return json_encode($response);
    }

    public function actionTour($id): string
    {
        $tour = Tours::getTourById($id);

        if (!$tour) {
            throw new NotFoundHttpException('Тура не существует');
        }

        return $this->render('tour', ['tour' => $tour]);
    }

    public function actionTourStart()
    {
        $response['success'] = false;

        if (empty($_POST['id'])) {
            return json_encode($response);
        }

        $tour = Tours::getTourById($_POST['id']);

        if (!$tour) {
            return json_encode($response);
        }

        $question = Questions::getFirstQuestion($tour->id);

        if (!$question) {
            return json_encode($response);
        }

        $response['success'] = true;
        $response['url'] = Url::to(['/site/question', 'id' => $question->id]);

        return json_encode($response);
    }

    public function actionNextTour()
    {
        $response['success'] = false;

        if (empty($_POST['id'])) {
            return json_encode($response);
        }


        $startedGameId = Session::getByKey(Session::CURRENT_GAME_ID);
        $gameId = GameToUser::getOriginGameId($startedGameId);
        $tour = Tours::getNextTour($gameId, $_POST['id']);

        $response['success'] = true;
        if (!$tour) {
            $response['url'] = Url::to(['/site/end-game', 'id' => $startedGameId]);
            return json_encode($response);
        }

        $response['url'] = Url::to(['/site/tour', 'id' => $tour->id]);

        return json_encode($response);
    }

    public function actionEndGame($id): string
    {
        $toursList = [];
        $stat = LineGameStats::getGameStatistic($id);

        if ($stat) {
            $toursList = LineGameStats::getToursList($stat);
        }

        return $this->render('endGame', ['stat' => $stat, 'toursList' => $toursList]);

    }
}
