<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\QueryStatus */
?>
<div class="query-status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'status',
        ],
    ]) ?>

</div>
