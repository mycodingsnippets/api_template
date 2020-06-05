<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item"
                   src="<?= $model->getVideoLink() ?>"
                   poster="<?= $model->getThumbnailLink() ?>"
                   controls></video>
        </div>
        <h6 class="mt-2"><?= $model->title ?></h6>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?= $model->getViews()->count() ?> views . <?= Yii::$app->formatter->asDate($model->created_at) ?>
            </div>
            <div>
                <?php Pjax::begin() ?>
                    <?= $this->render('_buttons', [
                            'model' => $model
                    ])  ?>
                <?php Pjax::end() ?>
            </div>
        </div>
        <div>
            <p>
                <?= \common\helpers\Html::channelLink($model->createdBy) ?>
            </p>
            <?= Html::encode($model->description) ?>
        </div>
    </div>
    <div class="col-sm-4">
        <?php foreach ($similarVideos as $similarVideo): ?>
            <div class="media mb-3">
                <a href="<?= \yii\helpers\Url::to(['videos/view', 'id'=>$similarVideo->video_id]) ?>">
                    <div class="embed-responsive embed-responsive-16by9 mr-2" style="width: 120px;">
                        <video class="embed-responsive-item"
                               src="<?= $similarVideo->getVideoLink() ?>"
                               poster="<?= $similarVideo->getThumbnailLink() ?>"></video>
                    </div>
                </a>
                <div class="media-body">
                    <h6 class="m-0"><?= $similarVideo->title ?></h6>
                    <div class="text-muted">
                        <p class="m-0"><?= \common\helpers\Html::channelLink($similarVideo->createdBy)?></p>
                        <small><?= $similarVideo->getViews()->count() ?> views . <?= Yii::$app->formatter->asRelativeTime($similarVideo->created_at) ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>