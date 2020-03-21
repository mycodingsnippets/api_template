<?php


namespace console\controllers;


use common\models\User;
use yii\console\Controller;
use yii\helpers\Console;

class AppController extends Controller
{
    public function actionAddUser($username, $password){
        $user = new User();
        $security = \Yii::$app->security;
        $user->username = $username;
        $user->password_hash = $security->generatePasswordHash($password);
        $user->access_token = $security->generateRandomString(255);
        if($user->save()){
            Console::output("Saved");
        }else{
            var_dump($user->errors);
            Console::output("Not Saved");
        }
    }
}