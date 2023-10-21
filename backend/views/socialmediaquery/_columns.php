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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'query_date',
    ],
	  [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'query_time',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
	 [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mobile',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'query_type',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'response_date',
    ],
	 [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'response_time',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'query_details',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'category',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hide_del_ban',
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
        'attribute'=>'cso_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'response_time_duration',
    ],
  
    [
        'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'media',
    ],
	  [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'remarks',
    ],
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

];   