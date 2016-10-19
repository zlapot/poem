<?php
namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\MyBehaviors;
use app\models\User;

class BehaviorsController extends Controller {
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                /*'denyCallback' => function ($rule, $action) {
                    throw new \Exception('Нет доступа.');
                },*/
                'only' => ['index', 'view', 'create', 'update', 'delete', 'model'],
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['anekdots', 'comments-anekdot', 'comments-hokky', 'comments-poem', 'user', 'hokkys', 'poems', 'default'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'model'],
                        'matchCallback' => function ($rule, $action) {
                           return  User::isUserAdmin(Yii::$app->user->id);
                        }
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['anekdots'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'model'],
                        'matchCallback' => function ($rule, $action) {
                           return true;
                        }
                    ],
                ]
            ],
            'removeUnderscore' => [
                'class' => MyBehaviors::className(),
                'controller' => Yii::$app->controller->id,
                'action' => Yii::$app->controller->action->id,
                'removeUnderscore' => Yii::$app->request->get('search')
            ]
        ];
    }
}