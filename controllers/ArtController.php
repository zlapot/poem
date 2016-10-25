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
use app\models\CommentsPoem;
use app\models\CommentsHokky;
use app\models\CommentsAnekdot;
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
        $this->redirect('poems');
    }   

    public function actionPoems()
    {
        $this->setLanguage();
        $query = Poems::find()
            ->from('poems')
            ->where(['status' => 1, 'isDelete' => 0]);
                //->all();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
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
        $this->setLanguage();
        $query = Anekdots::find()
            ->where(['status' => 1, 'isDelete' => 0])
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
        $this->setLanguage();
        $query = Hokkys::find()
            ->where(['status' => 1, 'isDelete' => 0])
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


    private function viewPost($postTableObject, $idPost, $commentTableObject, $commentTableName, $limit, $render)
    {   
        $model = new CommentForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if (!$model->addToPoem($id)){
                //error
            }
        }

        $post = $postTableObject->find()
                ->where(['id' => $idPost, 'status' => 1, 'isDelete' => 0])
                ->one();

        if(!$post){
            return $this->render('/site/error', [
                'name' => "#404: Page not found",
                'message' => 'Страница не найдена или находится в разработке, обратитесь к администратору ресурса'
            ]);
        }  

        $count = $commentTableObject->find()
            ->where([
                'id_poem' => $idPost,
            ])
            ->count();        
        
        $comment = (new \yii\db\Query()) 
            ->select([
                $commentTableName.'.id_poem', 
                $commentTableName.'.id',
                $commentTableName.'.comment',
                $commentTableName.'.date',
                'user.username',
                'user.img',
                ])
            ->where([$commentTableName.'.id_poem' => $idPost])
            ->from($commentTableName)
            ->leftJoin('user', $commentTableName.'.id_user = user.id')
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->limit($limit)
            ->all();        

        
        return $this->render($render, [
            'model' => $model,
            'post' => $post,
            'comments' => $comment,
            'count' => [
                'all' => $count,
                'current' => count($comment),
            ],
        ]);
    }

    public function actionPoem($id)
    {
        $this->setLanguage();
        return $this->viewPost(new Poems(), $id, new CommentsPoem(), 'comments_poem', 10, 'poem');       
    }

    public function actionHokky($id)
    {
        $this->setLanguage();
        return $this->viewPost(new Hokkys(), $id, new CommentsHokky(), 'comments_hokky', 10, 'hokky');
    }

    public function actionAnekdot($id)
    {
        $this->setLanguage();
        return $this->viewPost(new Anekdots(), $id, new CommentsAnekdot(), 'comments_anekdot', 10, 'anekdot');
    }


    private function setLanguage(){
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language', 'ru');
        return \Yii::$app->language = $language;
    }

}
