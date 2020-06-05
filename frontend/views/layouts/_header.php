<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-lg navbar-light bg-light shadow-sm'],
    'innerContainerOptions' => [
            'class' => 'container-fluid'
    ]
]);
$menuItems = [
    ['label' => 'Index', 'url' => ['/site/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => [
            'data-method' => 'post'
        ]
    ];
}
?>

    <form class="form-inline my-2 my-lg-0 ml-5" action="<?= \yii\helpers\Url::to(['videos/search']) ?>">
        <input type="search" class="form-control mr-sm-2" placeholder="Search" aria-label="Search" name="keyword"
         value="<?= Yii::$app->request->get('keyword') ?>" style="width: 500px">
        <button class="btn btn-outline-success my-2 my-sm-0">Search</button>
    </form>

<?php
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => $menuItems,
]);
NavBar::end();
?>