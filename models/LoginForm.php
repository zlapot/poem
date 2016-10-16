<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;
    public $status;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()){
            $user = $this->getUser();
            if  (!$user || !$user->validatePassword($this->password))
                $this->addError($attribute, 'Неправильное имя пользователя или пароль');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0 );
        else
            return false;
    }

    public function loginByOAuth($identity)
    {        
        if (isset($identity->profile)) {
            
            $servise = $identity->profile['service'];
            $id = $servise. $identity->profile['id'];
                       
            
            if(!User::findByName($id)) {
                $prof = $identity->profile;
                //$name = null;
                if(isset($identity->profile['full_name'])){
                    $name = $prof['full_name'];
                }
                else{
                    $name = $prof['name'];
                }

                $user = new User();
                $user->username = $name;
                $user->email = $id;
                $user->status = 10;
                $user->password = 0;
                $user->generateAuthKey();
                $user->secret_key = 0;
                $user->service = $prof['service'];
                $user->service_id = $prof['id'];     

                return $user->save(false) ? $user : null;
            }

            return User::findByName($id);       
        }
    }    

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }


}
