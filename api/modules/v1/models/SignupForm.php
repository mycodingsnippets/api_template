<?php


namespace api\modules\v1\models;


use common\models\User;
use Yii;
use yii\base\Model;


class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    public $_user;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['password', 'compare', 'compareAttribute'=>'password_repeat'],
            ['username', 'unique', 'targetClass'=>'common\models\User', 'message'=>'Username has already been taken']
        ];
    }

    public function register(){

        if($this->validate()){
            $user = new User();
            $security = \Yii::$app->security;

            $user->username = $this->username;
            $user->password_hash = $security->generatePasswordHash($this->password);
            $user->access_token = $security->generateRandomString(255);

            $this->_user = $user;

            if($user->save()){
//                return Yii::$app->user->login($user, 0);
                return true;
            }
            return false;
        }
        return false;
    }
}