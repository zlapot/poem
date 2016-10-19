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
use app\models\CommentForm;
use yii\data\Pagination;
use yii\web\Response;
use yii\helpers\BaseJson;
use yii\helpers\Json;
use yii\helpers\Url;

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
            ->orderBy([
                'id' => SORT_DESC,
            ])
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
            ->orderBy([
                'id' => SORT_DESC,
            ])
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
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->all();
        
        return $this->render('hokkys', [
            'hokkys' => $hokkys,
            'pagination' => $pagination,
        ]);
    }

    public function actionPoem($id)
    {
        $model = new CommentForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if (!$model->addToPoem($id)){
                //error
            }
        }

        $query = Poems::find()
                ->from('poems')
                ->where(['id' => $id])
                ->one();

        if(!$query){
            return $this->render(error);
        }
        
        $comment = (new \yii\db\Query()) 
            ->select([
                'comments_poem.id_poem', 
                'comments_poem.id',
                'comments_poem.comment',
                'comments_poem.date',
                'user.username'
                ])
            ->where(['comments_poem.id_poem' => $id])
            ->from('comments_poem')
            ->leftJoin('user', 'comments_poem.id_user = user.id')
            ->all();

        return $this->render('poem', [
            'model' => $model,
            'poem' => $query,
            'comments' => $comment,
        ]);
    }

    public function actionHokky($id)
    {
        $model = new CommentForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if (!$model->addToHokky($id)){
                //error
            }
        }

        $query = Hokkys::find()
                ->from('hokkys')
                ->where(['id' => $id])
                ->one();

        if(!$query){
            return $this->render(error);
        }

        $comment = (new \yii\db\Query()) 
            ->select([
                'comments_hokky.id_poem', 
                'comments_hokky.id',
                'comments_hokky.comment',
                'comments_hokky.date',
                'user.username'
                ])
            ->where(['comments_hokky.id_poem' => $id])
            ->from('comments_hokky')
            ->leftJoin('user', 'comments_hokky.id_user = user.id')
            ->all();

        return $this->render('hokky', [
            'model' => $model,
            'hokky' => $query,
            'comments' => $comment,
        ]);
    }

    public function actionAnekdot($id)
    {
        $model = new CommentForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if (!$model->addToAnekdot($id)){
                //error
            }
        }

        $query = Anekdots::find()
                ->from('anekdots')
                ->where(['id' => $id])
                ->one();

        if(!$query){
            return $this->render(error);
        }

        $comment = (new \yii\db\Query()) 
            ->select([
                'comments_anekdot.id_poem', 
                'comments_anekdot.id',
                'comments_anekdot.comment',
                'comments_anekdot.date',
                'user.username'
                ])
            ->where(['comments_anekdot.id_poem' => $id])
            ->from('comments_anekdot')
            ->leftJoin('user', 'comments_anekdot.id_user = user.id')
            ->all();

        return $this->render('anekdot', [
            'model' => $model,
            'anekdot' => $query,
            'comments' => $comment,
        ]);
    }

}
