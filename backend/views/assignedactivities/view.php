<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssignedActivities */
?>
<div class="assigned-activities-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'activity',
        ],
    ]) ?>

</div>
