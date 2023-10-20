<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
?>
<div class="customer-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_name',
            'contact_number',
			 'email',
            'company_name',
            'call_number_source',
            'customers_type',
            'customers_categories',
            'gender',
            'city',
            'zone',
            'location',
            'address',
            'app_install',
            'customer_level',
            'added_date',
            'added_by',
            'edit_date',
            'edit_by',
        ],
    ]) ?>

</div>
