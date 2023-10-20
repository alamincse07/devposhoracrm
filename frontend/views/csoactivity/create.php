<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CsoActivity */

$this->title = 'Create Cso Activity';
//$this->params['breadcrumbs'][] = ['label' => 'Cso Activities', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cso-activity-create">

   <?php /*?> <h1><?= Html::encode($this->title) ?></h1><?php */?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
