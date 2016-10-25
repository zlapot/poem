<?php

namespace app\models;
use yii\base\Model;
use app\models\User;
use yii\validators\EmailValidator;
use yii\helpers\Url;
use Yii;

class RegForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;

    public function rules()
    {
        return [
            [['username', 'email', 'password'],'filter', 'filter' => 'trim'],
            [['username', 'email', 'password'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 40],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя уже занято.'],
            [['email'], 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
            ]],
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common/auth', 'Логин'),
            'email' => Yii::t('common/auth', 'Эл. почта'),
            'password' => Yii::t('common/auth', 'Пароль'),
        ];
    }

    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->img = 'img/notava.png';

        if($this->scenario === 'emailActivation')
            $user->generateSecretKey();
        return $user->save(false) ? $user : null;
    }

    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом).'])
            ->setTo($this->email)
            ->setSubject('Активация для '.Yii::$app->name)
            ->send();
    }
}