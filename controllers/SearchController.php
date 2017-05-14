<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Search;
use yii\data\Pagination;
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
            ]
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
            ]
        ];
    }

    public function init()
    {        
        
    }

    public function actionIndex()
    {
        // TODO 
    }   

    public function actionPublic()
    {    
        $this->setLanguage();
        
        $model = new Search();        
        $model->search = Yii::$app->request->post('public_search');       

        $data = $model->Searching();             


        return $this->render('/art/poems', [
            'model' => $data['model'],
            'pagination' => $data['pagination'],
        ]);
    }

    private function setLanguage(){
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language', 'ru');
        return \Yii::$app->language = $language;
    }
}

