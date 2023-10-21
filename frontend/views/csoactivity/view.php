<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CsoActivity */
?>
<div class="cso-activity-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'call_number_source',
            'contact_number',
            'client_name',
            'client_type',
            'gender',
            'city',
            'zone',
            'location',
            'call_date',
            'cso_name',
            'call_start_time',
            'call_end_time',
            'call_duration',
            'call_status',
            'call_type',
            'notes',
            'service_category',
            'service_line',
            'action',
            'apointment_date',
            'status',
            'service_order_number',
            'order_gateway',
            'assigned_bp_name',
            'assigned_bp_number',
            'assigned_sp_name',
            'assigned_sp_number',
            'sp_quotation',
            'negotiated_price',
            'customer_agreed_price',
            'demurrage',
            'discount_amount',
            'sp_service_charge',
            'psl_service_charge',
            'vat',
            'total_invoice_amount',
            'customer_level',
            'dialer_id',
        ],
    ]) ?>

</div>
