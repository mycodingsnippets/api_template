<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class HelloController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionTestUrls(){
        print_r(Url::to('site/index'));
    }
}