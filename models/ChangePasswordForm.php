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
    private $_user;

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
        $this->_user = User::findIdentity(Yii::$app->user->id);
        if(!$this->_user)
            throw new InvalidParamException('Что-то пошло не так...');

        $user = $this->_user;
        if($user->validatePassword($this->password)){
            $user->setPassword($this->newpassword);
            return $user->save(false);
        }else{
            throw new InvalidParamException('Неверный пароль'); 
        }      
        
    }
}