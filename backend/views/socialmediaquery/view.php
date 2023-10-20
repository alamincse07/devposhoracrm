<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SocialMediaQuery */
?>
<div class="social-media-query-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'query_date',
			 'query_time',
            'name',
			 'mobile',
            'query_type',
            'response_date',
			 'response_time',
            'query_details',
            'category',
            'hide_del_ban',
			'sercatName',
			'serlineName',
            'cso_name',
            'response_time_duration',
            'remarks:ntext',
            'media',
        ],
    ]) ?>

</div>
