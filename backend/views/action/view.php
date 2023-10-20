<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Action */
?>
<div class="action-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'action',
        ],
    ]) ?>

</div>
