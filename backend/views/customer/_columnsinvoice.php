<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
        'attribute'=>'city',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'zone',
    ],
/*    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'location',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'address',
    ],
  
[
        'class' => 'kartik\grid\ActionColumn',
		
        'width' => '150px',
		
       'template' => '{INV}',
    'buttons' => [
	
	
       'INV' => function ($url, $model) {
           $url = Url::to(['salesactivity/create', 'id' => $model->id]);
          return Html::a('Create Sales', $url, ['title'=>'Invoice','class'=>'btn bg-olive']);
       },

    ]
    ],
  
];   