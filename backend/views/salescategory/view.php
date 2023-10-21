<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalesCategory */
?>
<div class="sales-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category',
        ],
    ]) ?>

</div>
