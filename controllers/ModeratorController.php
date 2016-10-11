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

    public function actionAddpoem()
    {
        $model = new PoemForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->add()){
                return $this->redirect(Url::to(['art/poems']), 302);
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
        $model = new AnekdotForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->add()){
                return $this->redirect(Url::to(['art/anekdots']), 302);
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
        $model = new HokkyForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->add()){ 
                return $this->redirect(Url::to(['art/hokkys']),302);
            }else{

            }
            
        }else{
            return $this->render('addhokky',[
                'model' => $model,
            ]);
        }
    }

}
