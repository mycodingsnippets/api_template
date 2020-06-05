<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Videos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


<!--    GridView => Special Class to implement Tables-->
<!--    DataProvider => Class that implements properties of tables like sorting-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'content' => function($model){
                    return $this->render('_video_item',[
                        'model' => $model
                    ]);
                }
            ],
            [
                'attribute' => 'status',
                'content' => function($model){
                    return $model->getStatusLabels()[$model->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                            'delete' => function($url){
                                return Html::a('Delete', $url, [
                                        'data-method' => 'post',
                                        'data-confirm' => 'Are you sure?'
                                ]);
                            }
                    ]
            ],
        ],
    ]); ?>


</div>
