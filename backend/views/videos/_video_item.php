<?php
?>
<div class="media">
    <a href="<?= \yii\helpers\Url::to(['/videos/update','id'=>$model->video_id]) ?>">
        <div class="embed-responsive embed-responsive-16by9 mr-2" style="width: 120px">
            <video class="embed-responsive-item"
                   src="<?= $model->getVideoLink() ?>"
                   poster="<?= $model->getThumbnailLink() ?>"></video>
        </div>
    </a>
    <div class="media-body">
        <h5 class="mt-0"><?= $model->title ?></h5>
        <?= \yii\helpers\StringHelper::truncateWords($model->description, 10)?>
    </div>
</div>
