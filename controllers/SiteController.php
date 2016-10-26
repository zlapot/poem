<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\SendEmailForm;
use app\models\ContactForm;
use app\models\PoemForm;
use app\models\Poems;
use app\models\Hokkys;
use app\models\Anekdots;
use app\models\User;
use yii\data\Pagination;
use yii\web\Response;
use yii\helpers\BaseJson;
use yii\helpers\Json;
use yii\helpers\Url;



class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'eauth' => [
                // required to disable csrf validation on OpenID requests
                'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                'only' => ['login'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //\Yii::$app->language = 'en';
        $this->setLanguage();
        
        $query = Poems::find()
            ->where(['status' => 1, 'isDelete' => 0]);
        $poems = $query
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->limit(2)
            ->all();

        $query = Hokkys::find()
            ->where(['status' => 1, 'isDelete' => 0]);
        $hokkys = $query
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->limit(3)
            ->all();

        $query = Anekdots::find()
            ->where(['status' => 1, 'isDelete' => 0]);
        $anekdots = $query
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->limit(3)
            ->all();
        
        return $this->render('index', [
            'poems' => $poems,
            'hokkys' => $hokkys,
            'anekdots' => $anekdots,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {      
        $this->setLanguage();
  
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        if (isset($serviceName)) {
            /** @var $eauth \nodge\eauth\ServiceBase */
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
            $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('site/login'));

            try {
                if ($eauth->authenticate()) {
//                  var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;

                    $identity = User::findByEAuth($eauth);
                    $user = $model->loginByOAuth($identity);
                    Yii::$app->user->login($user);

                    // special redirect with closing popup window
                    $eauth->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                }
            }
            catch (\nodge\eauth\ErrorException $e) {
                // save error to show it later
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());

                // close popup window and redirect to cancelUrl
//              $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }       

        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $reg = new RegForm();
        $reset = new SendEmailForm();

        return $this->render('login', [
            'model' => $model,
            'reg' => $reg,
            'reset' => $reset,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $this->setLanguage();

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->setLanguage();

        return $this->render('about');
    }     

    public function actionLang($id){
        switch($id){
            case 'ru' :
                $this->checkLanguage('ru');
                break;
            case 'eng' :
                $this->checkLanguage('en');
                break;
            case 'bib' :
                $this->checkLanguage('bb');
                break;
            case 'ukr' :
                $this->checkLanguage('ua');
                break;
            case 'imp' :
                $this->checkLanguage('im');
                break;
            case 'de' :
                $this->checkLanguage('de');
                break;
            case 'fr' :
                $this->checkLanguage('fr');
                break;
            default: 
                $this->checkLanguage('ru');
                break;  

        }
        
        return $this->redirect(Url::to(['site/index']), 302);
    }

    public function actionChangeCss($id)
    {
        switch ($id) {
            case 'commonflat':
                $this->cssChange($id);
                break;
            case 'common':
                $this->cssChange($id);
                break;

            default:
                $this->goBack();
                break;
        }

        $this->goBack();
    }

    private function cssChange($fileName)
    {
        $session = Yii::$app->session;
        if ($session->isActive){
            $_SESSION['css'] = 'css/'.$fileName.'.css';
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'css',
                'value' =>  $_SESSION['css'],
            ]));
            
        }else{
            $session->open();
            $_SESSION['css'] = 'css/'.$fileName.'.css';
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'css',
                'value' =>  $_SESSION['css'],
            ]));
        }
    }

    private function checkLanguage($lang){
        
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => $lang
        ]));
        
    }

    private function setLanguage(){
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language', 'ru');
        return \Yii::$app->language = $language;
    }
}
