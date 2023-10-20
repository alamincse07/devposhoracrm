<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CallType */
?>
<div class="call-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
        ],
    ]) ?>

</div>
