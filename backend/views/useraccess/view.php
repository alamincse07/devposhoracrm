<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserAccess */
?>
<div class="user-access-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'moduleName',
            'cname',
            'actions',
        ],
    ]) ?>

</div>
