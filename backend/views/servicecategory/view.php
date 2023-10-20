<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceCategory */
?>
<div class="service-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category',
        ],
    ]) ?>

</div>
