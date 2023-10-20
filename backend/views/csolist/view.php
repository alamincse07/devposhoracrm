<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CsoList */
?>
<div class="cso-list-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cso_name',
            'mobile',
        ],
    ]) ?>

</div>
