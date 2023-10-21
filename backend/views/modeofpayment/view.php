<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ModeOfPayment */
?>
<div class="mode-of-payment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'payment_mode',
        ],
    ]) ?>

</div>
