<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CsoCallSourceTarget */
?>
<div class="cso-call-source-target-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'target_from',
            'target_to',
            'target_daterange',
            'moduleName',
            'call_source',
            'target',
        ],
    ]) ?>

</div>
