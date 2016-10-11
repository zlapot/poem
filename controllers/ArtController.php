<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Poems;
use app\models\Anekdots;
use app\models\Hokkys;
use yii\data\Pagination;
use yii\web\Response;
use yii\helpers\BaseJson;
use yii\helpers\Json;

class ArtController extends Controller
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

    public function actionPoems()
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

    public function actionAnekdots()
    {
        $query = Anekdots::find()
            ->from('anekdots');
            //->all();
        $pagination = new Pagination([
            'defaultPageSize' => 9,
            'totalCount' => $query->count(),
        ]);
        
        $anekdots = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        return $this->render('anekdots', [
            'anekdots' => $anekdots,
            'pagination' => $pagination,
        ]);
    }

    public function actionHokkys()
    {
        $query = Hokkys::find()
            ->from('hokkys');
            //->all();
        $pagination = new Pagination([
            'defaultPageSize' => 9,
            'totalCount' => $query->count(),
        ]);
        
        $hokkys = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        return $this->render('hokkys', [
            'hokkys' => $hokkys,
            'pagination' => $pagination,
        ]);
    }

    public function actionPoem($id)
    {
        $query = Poems::find()
                ->from('poems')
                ->where(['id' => $id])
                ->one();

        if(!$query){
            return $this->render(error);
        }

        return $this->render('poem', [
           'poem' => $query,
        ]);
    }

    public function actionHokky($id)
    {
        $query = Hokkys::find()
                ->from('hokkys')
                ->where(['id' => $id])
                ->one();

        if(!$query){
            return $this->render(error);
        }

        return $this->render('hokky', [
           'hokky' => $query,
        ]);
    }

    public function actionAnekdot($id)
    {
        $query = Anekdots::find()
                ->from('anekdots')
                ->where(['id' => $id])
                ->one();

        if(!$query){
            return $this->render(error);
        }

        return $this->render('anekdot', [
           'anekdot' => $query,
        ]);
    }

}
