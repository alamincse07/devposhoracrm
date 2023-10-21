<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SocialMediaCategory */
?>
<div class="social-media-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category',
        ],
    ]) ?>

</div>
