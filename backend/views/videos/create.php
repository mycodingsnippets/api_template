<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Create Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="d-flex flex-column justify-content-center align-items-center">

        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>

        <br>

        <p class="m-0">Drag and drop a file you want to upload.</p>

        <br>

        <p class="text-muted">Your video will be private until you publish it.</p>

        <?php $form =  ActiveForm::begin([
                'options' => ['enctype'=>'multipart/form-data']
        ]) ?>
            <?= $form->errorSummary($model) ?>
            <button class="btn btn-primary btn-file">
                Select File
                <input type="hidden" name="_csrf-backend" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <input type="file" id="videoFile" name="video">
            </button>
        <?php ActiveForm::end() ?>
    </div>


</div>
