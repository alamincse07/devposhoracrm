<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SalesActivity */
$this->title = 'Create Sales';
?>
<div class="sales-activity-create">
    <?= $this->render('_form', [
      'model' => $model,  'todel' => $todel,
    ]) ?>
</div>
