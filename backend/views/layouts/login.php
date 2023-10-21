<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use app\assets\AdminLteAsset;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
   <link rel="shortcut icon" href="<?= Yii::$app->urlManagerFrontEnd->baseUrl . '/favicon.ico' ?>" type="image/x-icon" />
    <?php $this->head() ?>
</head>
<body class="login-page">

<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
