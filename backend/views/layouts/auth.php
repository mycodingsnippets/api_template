<?php

use common\widgets\Alert;

$this->beginContent('@backend/views/layouts/base.php');
?>


        <main class="d-flex">
            <div class="content-wrapper p-3">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
<?php $this->endContent(); ?>