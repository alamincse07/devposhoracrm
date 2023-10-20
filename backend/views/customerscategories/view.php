<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CustomersCategories */
?>
<div class="customers-categories-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category',
        ],
    ]) ?>

</div>
