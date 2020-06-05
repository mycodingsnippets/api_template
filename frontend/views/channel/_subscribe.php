<?php

use yii\helpers\Url;

?>
<a
    href="<?= Url::to(['channel/subscribe', 'username' => $channel->username])?>"
    data-method="post"
    data-pjax="1"
    class="btn <?= $channel->isSubscribed(Yii::$app->user->id) ? 'btn-secondary' : 'btn-danger'?>"
    role="button">
    Subscribe <i class="far fa-bell"></i>
</a> <?= $channel->getSubscribers()->count() ?>