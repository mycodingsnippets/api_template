<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index d-flex">
    <div class="card m-2" style="width: 14rem;">
        <?php if($latestVideo): ?>
        <div class="embed-responsive embed-responsive-16by9 mb-3">
            <video class="embed-responsive-item"
                   src="<?= $latestVideo->getVideoLink() ?>"
                   poster="<?= $latestVideo->getThumbnailLink() ?>"></video>
        </div>
        <div class="card-body">
            <h6 class="card-title"><?= $latestVideo->title ?></h6>
            <p class="card-text">
                Likes: <?=  $latestVideo->getLikes()->count() ?>
                Views: <?=  $latestVideo->getViews()->count() ?>
            </p>
            <a href="<?= \yii\helpers\Url::to(['videos/update', 'id' => $latestVideo->video_id])?>" class="btn btn-primary">Edit</a>
        </div>
        <?php else: ?>
            <div class="card-body">
                You haven't uploaded any videos yet
            </div>
        <?php endif; ?>
    </div>
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Total Views</h6>
            <p class="card-text" style="font-size: 72px;">
                <?= $numberOfView ?>
            </p>
        </div>
    </div>
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Total Subscriber</h6>
            <p class="card-text" style="font-size: 72px;">
                <?= $numberOfSubscribers ?>
            </p>
        </div>
    </div>
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Latest Subscribers</h6>
            <?php foreach ($subscribers as $subscriber): ?>
                <div><?= $subscriber->user->username ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
