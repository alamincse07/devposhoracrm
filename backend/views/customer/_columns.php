<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
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
        'attribute'=>'customer_name',
    ],
	   [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'company_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'contact_number',
    ],
	 
	 [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'call_number_source',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customers_type',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customers_categories',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'gender',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'city',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'zone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'location',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'address',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'app_install',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customer_level',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'added_date',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'added_by',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'edit_date',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'edit_by',
    ],

  
];   