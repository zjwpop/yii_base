<?php

use hubeiwei\yii2tools\widgets\Growl;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\web\View
 * @var $content string
 */

?>

<?php
$this->beginContent('@backend/views/layouts/master.php');

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'id' => 'top-menu',
        'class' => 'navbar-inverse my-navbar',
    ],
    'innerContainerOptions' => [
        'class' => ['container-fluid'],
    ],
]);

//echo Nav::widget([
//    'options' => ['class' => 'navbar-nav navbar-left'],
//    'items' => [
//    ],
//]);

//echo Nav::widget([
//    'options' => ['class' => 'navbar-nav navbar-right'],
//    'items' => [
//    ],
//]);

NavBar::end();
?>
<div class="wrap" id="main-container">
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => [
                'class' => 'breadcrumb',
                'style' => [
                    'background-color' => 'white',
                ],
            ],
        ]) ?>

        <?= Growl::widget() ?>

        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
