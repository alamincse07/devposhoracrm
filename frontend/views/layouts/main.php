<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
AppAsset::register($this);

$can_id = \Yii::$app->session->get('user.can_id');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
     <link rel="shortcut icon" href="<?=Url::to('@web/frontend/web/favicon.ico')?>" type="image/x-icon" />
    <?php $this->head() ?>
    <style>
	
.navbar-fixed-top {
    min-height: 80px;
}

	</style>
</head>
<body style="" >
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
/*    NavBar::begin([
        'brandLabel' => '<img src="'.Yii::$app->homeUrl.'/frontend/web/img/logo.png" style="display:inline; vertical-align: top; height:50px;">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-fixed-top',
			'style' =>'background:#F5F5F5;',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if ($can_id !='') {
       $menuItems[] = ['label' => \Yii::$app->session->get('user.username').' || Logout', 'url' => ['/site/signout']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();*/
    ?>

    <div class="container" style="margin-top:30px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; POSHORA <?= date('Y') ?></p>

       <?php /*?> <p class="pull-right"><?= Yii::powered() ?></p><?php */?>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
