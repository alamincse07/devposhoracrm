<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SsrTarget */
?>
<div class="ssr-target-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'target_from',
            'target_to',
            'target_daterange',
            'moduleName',
            'spot_sales_target',
            'spot_sales_amount_target',
            'sp_sourcing_in_hand_target',
            'client_visit_for_service_assess_target',
            'client_visit_during_service_target',
        ],
    ]) ?>

</div>
