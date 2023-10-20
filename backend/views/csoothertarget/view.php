<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CsoOtherTarget */
?>
<div class="cso-other-target-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'target_from',
            'target_to',
            'target_daterange',
            'moduleName',
            'sales_conversion_target',
            'sales_amount_target',
            'call_target',
        ],
    ]) ?>

</div>
