<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BpList */
?>
<div class="bp-list-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bp_name',
            'mobile',
            'moduleName',
        ],
    ]) ?>

</div>
