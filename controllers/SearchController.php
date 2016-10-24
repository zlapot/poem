<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Poems;
use app\models\Search;
use yii\data\Pagination;
use yii\web\Response;
use yii\helpers\BaseJson;
use yii\helpers\Json;

class SearchController extends Controller
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

    
    public function actionIndex()
    {
        
    }   

    public function actionPublic()
    {    
        $this->setLanguage();
        
        $model = new Search();        
        $search = Yii::$app->request->post();
        $model->search=$search['public_search'];

        $query = $model->Searching($model->search);

        $pagination = new Pagination([
            'defaultPageSize' => 9,
            'totalCount' => $query->count(),
        ]);
        
        $poems = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        return $this->render('/art/poems', [
            'poems' => $poems,
            'pagination' => $pagination,
        ]);
    }

    private function setLanguage(){
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language', 'ru');
        return \Yii::$app->language = $language;
    }
}

}
