<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerLevel */
?>
<div class="customer-level-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'level',
        ],
    ]) ?>

</div>
