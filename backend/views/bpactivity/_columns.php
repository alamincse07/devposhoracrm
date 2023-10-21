<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
   /* [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
      [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'id',
     ],*/
	     [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'bp_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'bp_name',
    ],
  /*  [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'assigned_person',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'week_day',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'company_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'clients_representative_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'clients_representative_number',
    ],
	 [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customer_email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'work_start_time',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'work_end_time',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'work_duration',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'moduleName',
    ],
   
	 [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'zoneName',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'address',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'daily_status',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'assigned_activities',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'job_type',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customers_categories',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'query_status',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'sercatName',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'serlineName',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'leaflet_distribution_number',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'apps_installed',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'notes',
    ],


];   