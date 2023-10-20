<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalesActivity */
?>
<div class="sales-activity-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'invoice_no',
            'invoice_date',
            'sales_catagories',
			 'sales_status',
            'service_order_gateway',
            'service_date',
            'sercatName',
            'serlineName',
            'company_name_b2b',
            'customer_name',
            'customer_mobile',
            'customer_email:email',
            'customer_address',
            'sp_name',
            'sp_cell_number',
            'city',
			 'zone',
            'location',
            'address',
            'mode_of_payments',
			 'receiver_name',
			'field_representative',
            'name_of_representative',
            'poshora_received_date',
            'invoice_bill',
            'ssl_charge',
            'vat',
            'service_charge',
            'ssl_charge_factoring',
            'poshora_charge',
            'sp_service_charges',
            'poshora_received',
            'additional_received',
            'sp_spare_parts',
            'sp_discount_demurrage',
            'poshora_spare_parts',
            'poshora_discount_demurrage',
            'net_bill_claimed',
            'deduction_vat',
            'deduction_ait',
            'net_paid',
            'remarks:ntext',
			 'added_date',
            'added_by',
            'edit_date',
            'edit_by',
        ],
    ]) ?>

</div>
