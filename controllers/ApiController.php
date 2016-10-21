<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Poems;
use app\models\Hokkys;
use app\models\Anekdots;
use app\models\User;
use yii\data\Pagination;
use yii\web\Response;
use yii\helpers\BaseJson;
use yii\helpers\Json;
use yii\helpers\Url;

class ApiController extends Controller
{
   
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
        echo "Это API";
    }

        

    public function actionPoemAjax()
    {
        //if (Yii::$app->request->get()){
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


            echo \yii\helpers\Html::encode($this->render('/art/poems', [
                    'poems' => $poems,
                    'pagination' => $pagination,
                ]));

            echo "hjhjhj";
            
       // }
    }

    public function actionPoemAjaxJson()
    {
        if (Yii::$app->request->isPost){
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

            foreach ($poems as $poem) {
                $poem->poem = Poems::cutStr($poem->poem, 350);
            }
           
            //echo \yii\helpers\Json::encode($poems);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            //return $poems;
            return ['data' => $poems];

        }else{
            echo 'You should use POST response';
        }
    }

    
}
