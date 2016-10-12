<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PoemForm;
use app\models\Poems;
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
        $query = Poems::find()
            ->from('poems');
            //->all();
        $pagination = new Pagination([
            'defaultPageSize' => 9,
            'totalCount' => $query->count(),
        ]);
        
        $poems = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        return $this->render('poems', [
            'poems' => $poems,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
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
        return $this->render('about');
    }

    

    public function actionAddpoemajax()
    {
        $model = new PoemForm();

        if (Yii::$app->request->post()){                     
            $r = (Yii::$app->request->post());

            echo $r;
        }else{
            echo "Error";
        }
    }

    public function actionPoemajax()
    {
        if (Yii::$app->request->post()){
            $query = Poems::find()
                ->from('poems');
                //->all();
            $pagination = new Pagination([
                'defaultPageSize' => 9,
                'totalCount' => $query->count(),
            ]);
            
            $poems = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            echo \yii\helpers\Json::encode($poems);
            
        }
    }

    public function actionLang($id){
        switch($id){
            case 'ru' :
                $this->checkLanguage('ru');
                break;
            case 'eng' :
                $this->checkLanguage('eng');
                break;
            case 'bib' :
                $this->checkLanguage('bib');
                break;
            case 'ukr' :
                $this->checkLanguage('ukr');
                break;
            case 'imp' :
                $this->checkLanguage('imp');
                break;
            case 'ar' :
                $this->checkLanguage('ar');
                break;
            case 'bas' :
                $this->checkLanguage('bas');
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

    private function checkLanguage($lang){
        
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => $lang
        ]));
        
    }
}
