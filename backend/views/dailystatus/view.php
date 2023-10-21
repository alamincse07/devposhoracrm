<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DailyStatus */
?>
<div class="daily-status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'status',
        ],
    ]) ?>

</div>
