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
use app\models\CommentForm;
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

       // }
    }

    public function actionPoemAjaxJson()
    {
        if (Yii::$app->request->isPost){
            $query = Poems::find()
                ->from('poems');
                //->all();
            $pagination = new Pagination([
                'defaultPageSize' => 10,
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

    public function actionAnekdotAjaxJson()
    {
        if (Yii::$app->request->isPost){
            $query = Anekdots::find()
                ->from('anekdots');
                //->all();
            $pagination = new Pagination([
                'defaultPageSize' => 9,
                'totalCount' => $query->count(),
            ]);
            
            $poems = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            
            //echo \yii\helpers\Json::encode($poems);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            //return $poems;
            return ['data' => $poems];

        }else{
            echo 'You should use POST response';
        }
    }

    public function actionHokkyAjaxJson()
    {
        if (Yii::$app->request->isPost){
            $query = Hokkys::find()
                ->from('hokkys');
                //->all();
            $pagination = new Pagination([
                'defaultPageSize' => 9,
                'totalCount' => $query->count(),
            ]);
            
            $poems = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            
            //echo \yii\helpers\Json::encode($poems);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            //return $poems;
            return ['data' => $poems];

        }else{
            echo 'You should use POST response';
        }
    }

    public function actionInstallImage()
    {
        if (Yii::$app->request->isPost){
            
            $post = Yii::$app->request->post();           
            
            if(isset($post['img'])){
                if($post['img']>=0 && $post['img']<21){
                    $user = User::findIdentity(Yii::$app->user->id);
                    $user->img = 'img/avatar/'.$post['img'].'.jpg';
                    $user->save(false);
                    echo  'ok';
                }
                else{
                    echo "fail";
                }
            }
        }else{
            echo 'You should use POST response';
        }
    }

    private function doneCommentJson($data)
    {
        $ident = Yii::$app->user->identity;
        return [[
            'id' => $data->id,
            'comment' => $data->comment,
            'date' => $data->date,
            'username' => $ident->username,
            'img' => Url::home().$ident->img,
        ]];
    }

    public function actionCommentPoemAjax()
    {
        if(!Yii::$app->user->isGuest){
            if (Yii::$app->request->isPost){
                $post = Yii::$app->request->post('CommentForm');
                $comment = new CommentForm();    

                $comment->comment = $post['comment'];
                if($comment->comment != '')
                {
                    $data = $comment->addToPoem($post['idpost']);
                    if($data){                          
                        $json = $this->doneCommentJson($data);
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return ['data' => $json];
                    }else{
                        echo "fail";
                    }
                }else{
                    echo 'fail';
                }
                
            }
        }
        else{
            echo "You're guest!!";
        }
    }

    public function actionCommentHokkyAjax()
    {
        if(!Yii::$app->user->isGuest){
            if (Yii::$app->request->isPost){
                $post = Yii::$app->request->post('CommentForm');
                $comment = new CommentForm();    

                $comment->comment = $post['comment'];
                if($comment->comment != '')
                {
                    $data = $comment->addToHokky($post['idpost']);
                    if($data){
                        $json = $this->doneCommentJson($data);
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return ['data' => $json];
                    }else{
                        echo "fail";
                    }
                }else{
                    echo 'fail';
                }
                
            }
        }
        else{
            echo "You're guest!!";
        }
    }

    public function actionCommentAnekdotAjax()
    {
        if(!Yii::$app->user->isGuest){
            if (Yii::$app->request->isPost){
                $post = Yii::$app->request->post('CommentForm');
                $comment = new CommentForm();    

                $comment->comment = $post['comment'];
                if($comment->comment != '')
                {
                    $data = $comment->addToAnekdot($post['idpost']);
                    if($data){
                        $json = $this->doneCommentJson($data);
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return $json;
                    }else{
                        echo "fail";
                    }
                }else{
                    echo 'fail';
                }
                
            }
        }
        else{
            echo "You're guest!!";
        }
    }    

    public function actionDeleteCommentAjax()
    {
        if(!Yii::$app->user->isGuest){
            if (Yii::$app->request->isPost){
                $post = Yii::$app->request->post();
                if(isset($post)){
                    $flag = false;
                    $comment = new CommentForm(); 
                    switch ($post['category']) {
                        case 'poem':
                            $flag = $comment->delFromPoem($post['id']);
                            break;

                        case 'hokky':
                            $flag = $comment->delFromHokky($post['id']);
                            break;

                        case 'anekdot':
                            $flag = $comment->delFromAnekdot($post['id']);
                            break;
                        
                        default:
                            break;
                    }
                    
                    if($flag){
                        echo 'ok';
                    }else{
                        echo "fail";
                    }
                }

            }
        }
        else{
            echo "You're guest!!";
        }
    }    
    
}
