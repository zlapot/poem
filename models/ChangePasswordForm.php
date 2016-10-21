<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use app\models\User;
class ChangePasswordForm extends Model
{
    public $password;
    public $newpassword;

    public function rules()
    {
        return [
            [['password','newpassword'], 'required'],
            [['password','newpassword'], 'string','min' => 6, 'max' => 255],
            [['password','newpassword'], 'filter', 'filter' => 'trim'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'password' => 'Старый пароль',
            'newpassword' => 'Новый пароль'
        ];
    }

    
    
    public function changePassword()
    {
        /* @var $user User */
        $_user = User::findIdentity(Yii::$app->user->id);
        if(!$_user)
            throw new InvalidParamException('Что-то пошло не так...');

        $user = $_user;
        if($user->validatePassword($this->password)){
            $user->setPassword($this->newpassword);
            $user->save(false);
            return true;
        }else{
            return false;
        }      
        
    }
}