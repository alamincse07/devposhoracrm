<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CsoActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cso-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reference_date') ?>

    <?= $form->field($model, 'call_number_source') ?>

    <?= $form->field($model, 'contact_number') ?>

    <?= $form->field($model, 'client_name') ?>

    <?php // echo $form->field($model, 'client_type') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'zone') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'call_date') ?>

    <?php // echo $form->field($model, 'cso_name') ?>

    <?php // echo $form->field($model, 'call_start_time') ?>

    <?php // echo $form->field($model, 'call_end_time') ?>

    <?php // echo $form->field($model, 'call_duration') ?>

    <?php // echo $form->field($model, 'call_status') ?>

    <?php // echo $form->field($model, 'call_type') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'service_category') ?>

    <?php // echo $form->field($model, 'service_line') ?>

    <?php // echo $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'apointment_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'service_order_number') ?>

    <?php // echo $form->field($model, 'order_gateway') ?>

    <?php // echo $form->field($model, 'assigned_bp_name') ?>

    <?php // echo $form->field($model, 'assigned_bp_number') ?>

    <?php // echo $form->field($model, 'assigned_sp_name') ?>

    <?php // echo $form->field($model, 'assigned_sp_number') ?>

    <?php // echo $form->field($model, 'sp_quotation') ?>

    <?php // echo $form->field($model, 'negotiated_price') ?>

    <?php // echo $form->field($model, 'customer_agreed_price') ?>

    <?php // echo $form->field($model, 'demurrage') ?>

    <?php // echo $form->field($model, 'discount_amount') ?>

    <?php // echo $form->field($model, 'sp_service_charge') ?>

    <?php // echo $form->field($model, 'psl_service_charge') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'total_invoice_amount') ?>

    <?php // echo $form->field($model, 'customer_level') ?>

    <?php // echo $form->field($model, 'dialer_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
