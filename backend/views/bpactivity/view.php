<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BpActivity */
?>
<div class="bp-activity-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bp_id',
            'bp_name',
            'assigned_person',
            'date',
            'week_day',
            'company_name',
            'clients_representative_name',
            'clients_representative_number',
			 'customer_email',
            'work_start_time',
            'work_end_time',
            'work_duration',
            'moduleName',
            'zoneName',
            'address',
            'daily_status',
            'assigned_activities',
            'job_type',
            'customers_categories',
            'query_status',
            'sercatName',
            'serlineName',
            'leaflet_distribution_number',
            'apps_installed',
            'notes',
        ],
    ]) ?>

</div>
