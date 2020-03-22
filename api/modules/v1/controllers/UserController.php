<?php


namespace api\modules\v1\controllers;

use api\modules\v1\models\SignupForm;
use common\models\LoginForm;
use Yii;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            return $model->getUser()->toArray(['id', 'username', 'access_token']);
        } else {
            Yii::$app->response->statusCode = 422;
            return [
                 'errors' =>  $model->errors
            ];
        }
    }

    public function actionSignup(){
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post(),'') && $model->register()){
            return $model->_user->toArray(['id', 'username', 'access_token']);
        }
        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }
}