<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;
    const ROLE_ADMIN = 20;
    
        
    public $authKey;
    public $accessToken;
    public $profile;

    

    public static function tableName()
    {
        return 'user';
    }

    
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'status', 'auth_key', 'created_at', 'updated_at', 'secret_key'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 100],
            [['password_hash', 'secret_key', 'service', 'service_id', 'name'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Ник',
            'email' => 'Email',
            'password' => 'Password Hash',
            'status' => 'Статус',
            'auth_key' => 'Auth Key',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    // Find Identity

    public static function findIdentity($id)
    {
        if (Yii::$app->getSession()->has('user-'.$id)) {
            return new self(Yii::$app->getSession()->get('user-'.$id));
        }
        else {
            return static::findOne([
                'id' => $id,
                'status' => self::STATUS_ACTIVE
            ]);
        }
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
         return static::findOne(['access_token' => $token]);
    }

    public static function findByEAuth($service) {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }

        $id = $service->getServiceName().'-'.$service->getId();
        $attributes = [
            'id' => $id,
            'username' => $service->getAttribute('name'),
            'authKey' => md5($id),
            'profile' => $service->getAttributes(),
        ];
        $attributes['profile']['service'] = $service->getServiceName();
        Yii::$app->getSession()->set('user-'.$id, $attributes);
        return new self($attributes);
    }

    // Find Identity END
    // Find by

    public static function findByUsername($username)
    {
        return static::findOne([
            'username' => $username
        ]);
    }

    public static function findByName($username)
    {
        return static::findOne([
            'email' => $username
        ]);
    }

    public static function findByEmail($email)
    {
        return static::findOne([
            'email' => $email
        ]);
    }

    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyExpire($key))
        {
            return null;
        }
        return static::findOne([
            'secret_key' => $key,
        ]);
    }

    // Find by END
    // Secret key

    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString().'_'.time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }

    public static function isSecretKeyExpire($key)
    {
        if (empty($key))
        {
            return false;
        }
        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    // Secret Key END

    // Password

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }    

    // Password END

    public function getId()
    {
        return $this->id;
    }    

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }  
    
    public static function isUserAdmin($id)
    {
        if (static::findOne(['id' => $id, 'role' => self::ROLE_ADMIN]))
        {
            return true;
        } else {
            return false;
        }
    }
    
}
