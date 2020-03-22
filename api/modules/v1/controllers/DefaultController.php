<?php


namespace api\modules\v1\controllers;


use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex($first, $last){
        echo $first . ' ' . $last;
    }

    public function actionTest($id){
        echo $id;
    }

    public function actionContentRender(){
        $this->layout = 'main';
        return $this->renderContent("Aditya Bansal");
    }
}