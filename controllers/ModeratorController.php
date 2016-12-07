<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PoemForm;
use app\models\AnekdotForm;
use app\models\HokkyForm;
use app\models\Poems;
use app\models\Anekdots;
use app\models\Hokkys;
use yii\data\Pagination;
use yii\web\Response;
use yii\helpers\BaseJson;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\User;

class ModeratorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'addpoem', 'addanekdot', 'addhokky', 'index', 'editanekdot', 'edithokky', 'editpoem', 'newanekdot', 'newhokky', 'newpoem'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['addpoem', 'addanekdot', 'addhokky'],
                        'allow' => true,
                        'roles' => ['@'],
                        //'matchCallback' => function ($rule, $action) {
                           //return  User::isUserAdmin(Yii::$app->user->id);
                        //}
                    ],
                    [
                        'actions' => ['editanekdot', 'edithokky', 'editpoem', 'newanekdot', 'newhokky', 'newpoem'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                           return  User::isUserAdmin(Yii::$app->user->id);
                        }
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

    public function actionIndex()
    {
        $this->redirect(Url::to(['user/profile']), 302);
    }

    public function actionAddpoem()
    {
        $this->setLanguage();
        $model = new PoemForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->add()){
                $this->setFlash();
                return $this->render('addpoem',[
                    'model' => new PoemForm(),
                ]);
            }else{

            }

        }else{
            return $this->render('addpoem',[
                'model' => $model,
            ]);
        }
    }

    public function actionAddanekdot()
    {
        $this->setLanguage();
        $model = new AnekdotForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->add()){
                $this->setFlash();
                return $this->render('addanekdot',[
                    'model' => new AnekdotForm(),
                ]);
            }else{

            }

        }else{
            return $this->render('addanekdot',[
                'model' => $model,
            ]);
        }
    }

    public function actionAddhokky()
    {
        $this->setLanguage();
        $model = new HokkyForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->add()){ 
                $this->setFlash();
                return $this->render('addhokky',[
                    'model' => new HokkyForm(),
                ]);
            }else{

            }
            
        }else{
            return $this->render('addhokky',[
                'model' => $model,
            ]);
        }
    }

    public function actionNewpoem()
    {
        $query = Poems::find()
            ->where(['status' => 0, 'isDelete' => 0])
            ->count();

        $pagination1 = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query,
        ]);

        $query = Poems::find()
            ->where(['status' => 1, 'isDelete' => 0])
            ->count();

        $pagination2 = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query,
        ]);
        
        $newpost = $this->query(new Poems(), $pagination1, 0);
        $publpost = $this->query(new Poems(), $pagination1, 1);
        
        return $this->render('newpoem', [
            'newpost' => $newpost,
            'pagination1' => $pagination1,
            'publpost' => $publpost,
            'pagination2' => $pagination2,
        ]);
    }

    public function actionNewanekdot()
    {
        $query = Anekdots::find()
            ->where(['status' => 0, 'isDelete' => 0])
            ->count();

        $pagination1 = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query,
        ]);

        $query = Anekdots::find()
            ->where(['status' => 1, 'isDelete' => 0])
            ->count();

        $pagination2 = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query,
        ]);
        
        $newpost = $this->query(new Anekdots(), $pagination1, 0);
        $publpost = $this->query(new Anekdots(), $pagination1, 1);
        
        return $this->render('newpoem', [
            'newpost' => $newpost,
            'pagination1' => $pagination1,
            'publpost' => $publpost,
            'pagination2' => $pagination2,
        ]);
    }

    public function actionNewhokky()
    {
        $query = Hokkys::find()
            ->where(['status' => 0, 'isDelete' => 0])
            ->count();

        $pagination1 = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query,
        ]);

        $query = Hokkys::find()
            ->where(['status' => 1, 'isDelete' => 0])
            ->count();

        $pagination2 = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query,
        ]);
        
        $newpost = $this->query(new Hokkys(), $pagination1, 0);
        $publpost = $this->query(new Hokkys(), $pagination1, 1);
        
        return $this->render('newpoem', [
            'newpost' => $newpost,
            'pagination1' => $pagination1,
            'publpost' => $publpost,
            'pagination2' => $pagination2,
        ]);
    }

    public function actionAddanekdot($id)
    {
        $model = new AnekdotForm::find($id);

        return $this->render('editanekdot',[
            'model' => $model,
        ]);
        
    }

    private function query($model, $pagination, $status)
    {  
        $post = $model->find()
            ->where(['status' => $status, 'isDelete' => 0])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->all();

        return $post;
    }

    private function setFlash()
    {
        $session = Yii::$app->session;
        $session->setFlash('postAdded', '*'.Yii::t('common/title', 'Ваша заявка на публикацию была принята, администрация рассмотрит ее в ближайшее время, спасибо за ваш вклад в развитие данного проекта. Просьба придерживаться правил (они есть на нашем сайте).'));
    }

    private function setLanguage(){
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language', 'ru');
        return \Yii::$app->language = $language;
    }

}
