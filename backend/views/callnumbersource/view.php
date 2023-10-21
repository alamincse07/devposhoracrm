<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CallNumberSource */
?>
<div class="call-number-source-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'source',
        ],
    ]) ?>

</div>
