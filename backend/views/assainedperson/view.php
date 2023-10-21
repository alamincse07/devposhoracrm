<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssainedPerson */
?>
<div class="assained-person-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'mobile',
        ],
    ]) ?>

</div>
