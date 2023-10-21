<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceLines */
?>
<div class="service-lines-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'lines',
        ],
    ]) ?>

</div>
