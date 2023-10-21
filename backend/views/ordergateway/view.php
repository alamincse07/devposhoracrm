<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderGateway */
?>
<div class="order-gateway-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gateway',
        ],
    ]) ?>

</div>
