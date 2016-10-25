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
use app\models\CommentsPoem;
use app\models\CommentsHokky;
use app\models\CommentsAnekdot;
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
            'img' => $ident->img,
        ]];
    }

    private function responseData($data){
        if($data){                          
            $json = $this->doneCommentJson($data);
            return ['data' => $json];
        }
    }

    private function commentPostAjax($addTo)
    {
        if(!Yii::$app->user->isGuest){
            if (Yii::$app->request->isPost){
                $post = Yii::$app->request->post('CommentForm');
                $comment = new CommentForm();    

                $comment->comment = $post['comment'];
                if($comment->comment != '')
                {
                    switch ($addTo) {
                        case 'poem':
                            $data = $comment->addToPoem($post['idpost']);
                            return $this->responseData($data);
                            break;
                        case 'hokky':
                            $data = $comment->addToHokky($post['idpost']);
                            return $this->responseData($data);
                            break;
                        case 'anekdot':
                            $data = $comment->addToAnekdot($post['idpost']);
                            return $this->responseData($data);
                            break;
                        
                        default:
                        echo 'fail';
                            break;
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

    public function actionCommentPoemAjax()
    {                            
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->commentPostAjax('poem');
    }

    public function actionCommentHokkyAjax()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->commentPostAjax('hokky');
    }

    public function actionCommentAnekdotAjax()
    {   
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->commentPostAjax('anekdot');
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


    public function actionShowPoem()
    {
         if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(isset($post['id'])){
                $poem = Poems::findOne($post['id']);
                echo $poem->poem;
            }
            else{
                echo "Произошла неизвестная ошибка";
            }
         }
    }

    private function showComment($idPost, $commentTableObject, $commentTableName, $limit, $offset)
    {                
        
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
            ->offset($offset)
            ->limit($limit)
            ->all();  
        
        //$json = \yii\helpers\Json::encode(['data' => $comment]);
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['data' => $comment];//$json;
    }

    public function actionShowCommentAjax()
    {
        if(!Yii::$app->user->isGuest){
            if (Yii::$app->request->isPost){
                $post = Yii::$app->request->post();
                if(isset($post)){
                    $comment = new CommentForm(); 
                    switch ($post['category']) {
                        case 'poem':
                            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                            return $this->showComment($post['idPost'], new CommentsPoem(), "comments_poem", 10, $post['offset']);
                            break;

                        case 'hokky':
                            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                            return $this->showComment($post['idPost'], new CommentsHokky(), "comments_hokky", 10, $post['offset']);
                            break;

                        case 'anekdot':
                            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                            return $this->showComment($post['idPost'], new CommentsAnekdot(), "comments_anekdot", 10, $post['offset']);
                            break;
                        
                        default:
                            break;
                    }                    
                }
            }
        }
    } 
    
}
