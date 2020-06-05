<?php

use yii\widgets\Pjax;

?>
<div class="jumbotron">
    <h1 class="display-4"><?= $channel->username ?></h1>
    <hr class="my-4">
    <?php Pjax::begin() ?>
        <?= $this->render('_subscribe',[
                'channel' => $channel
        ]) ?>
    <?php Pjax::end() ?>
</div>

<?=
\yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@frontend/views/videos/_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false
    ]
])
?>