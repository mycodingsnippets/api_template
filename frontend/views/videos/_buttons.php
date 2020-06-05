<a href="<?= \yii\helpers\Url::to(['videos/like', 'id' => $model->video_id])?>" data-method="post" data-pjax="1" class="btn btn-sm <?= $model->isLikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary' ?>">
    <i class="fas fa-thumbs-up"></i> <?= $model->getLikes()->count(); ?>
</a>
<a href="<?= \yii\helpers\Url::to(['videos/dislike', 'id' => $model->video_id])?>" data-method="post" data-pjax="1" class="btn btn-sm <?= $model->isDislikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary' ?>">
    <i class="fas fa-thumbs-down"></i> <?= $model->getDislikes()->count(); ?>
</a>