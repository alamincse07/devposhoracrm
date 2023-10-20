<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker; 
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

use app\models\Action;
use app\models\AssainedPerson;
use app\models\AssignedActivities;

use app\models\BpList;
use app\models\CallNumberSource;
use app\models\CallType;
use app\models\City;
use app\models\ClientType;
use app\models\CsoActivity;
use app\models\CustomerLevel;
use app\models\CustomersCategories;
use app\models\DailyStatus;
use app\models\JobType;
use app\models\Location;
use app\models\OrderGateway;
use app\models\QueryStatus;
use app\models\Status;
use app\models\Zone;
use app\models\ServiceLines;
use app\models\ServiceCategory;

/* @var $this yii\web\View */
/* @var $model app\models\CsoActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cso-activity-form">

    <?php $form = ActiveForm::begin(); ?>



      <?= $form->field($model, 'call_number_source')->dropDownList( ArrayHelper::map(CallNumberSource::find()->all(), 'source', 'source'),['prompt'=>'']) ?>

    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_type')->dropDownList( ArrayHelper::map(ClientType::find()->all(), 'type', 'type'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other', ], ['prompt' => '']) ?>
    
      <?= $form->field($model, 'city')->dropDownList( ArrayHelper::map(City::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),['id'=>'city','prompt'=>'']) ?> 

  
    <?
		echo $form->field($model, 'zone')->widget(DepDrop::classname(), [
    'options'=>['id'=>'zone'],
    'pluginOptions'=>[
        'depends'=>['city'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/site/zone'])
    ]
]);
	
	?>
            <?
				echo $form->field($model, 'location')->widget(DepDrop::classname(), [
				'options'=>['id'=>'location'],
					'pluginOptions'=>[
						'depends'=>['city', 'zone'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['/site/location'])
					]
				]);
			
			?>
             
        


    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

<? if($model->call_date){$call_date= $model->call_date;}else{$call_date=date('Y-m-d');} ?>
    <?= $form->field($model, 'call_date')->textInput(['maxlength' => true, 'value'=>$call_date,'readonly'=> true]) ?>
    
    <? if($model->cso_name){$cso_name= $model->cso_name;}else{$cso_name=Yii::$app->apu->sesdata('username');} ?>

    <?= $form->field($model, 'cso_name')->textInput(['maxlength' => true, 'value'=>$cso_name,'readonly'=> true]) ?>

    <?= $form->field($model, 'call_start_time')->textInput(['maxlength' => true, 'readonly'=> true]) ?>

    <?= $form->field($model, 'call_end_time')->textInput(['maxlength' => true, 'readonly'=> true]) ?>

    <?= $form->field($model, 'call_duration')->textInput(['maxlength' => true, 'readonly'=> true]) ?>

    <?= $form->field($model, 'call_status')->dropDownList(['Interested' => 'Interested',
				'No Answer' => 'No Answer',
				'Busy' => 'Busy',
				'Not Interested' => 'Not Interested',
				'Switched Off' => 'Switched Off',
				'Wrong Number' => 'Wrong Number',], ['prompt' => '']) ?> 

   <?= $form->field($model, 'call_type')->dropDownList( ArrayHelper::map(CallType::find()->all(), 'type', 'type'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'notes')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'service_category')->dropDownList( ArrayHelper::map(ServiceCategory::find()->orderBy(['category' => SORT_ASC])->all(), 'id', 'category'),['id'=>'sc','prompt'=>'']) ?> 


      <?
					echo $form->field($model, 'service_line')->widget(DepDrop::classname(), [
					'options'=>['id'=>'sl'],
					'pluginOptions'=>[
						'depends'=>['sc'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['/site/servicelines'])
					]
				]);
			
			?>
     <?= $form->field($model, 'action')->dropDownList( ArrayHelper::map(Action::find()->all(), 'action', 'action'),['prompt'=>'']) ?> 

  <?= $form->field($model, 'apointment_date')->textInput(['maxlength' => true]) ?>
     <?//= ''.$form->field($model,'apointment_date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>

 <?= $form->field($model, 'status')->dropDownList( ArrayHelper::map(Status::find()->all(), 'status', 'status'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'service_order_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_gateway')->dropDownList( ArrayHelper::map(OrderGateway::find()->all(), 'gateway', 'gateway'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'assigned_bp_name')->dropDownList( ArrayHelper::map(BpList::find()->all(), 'id', 'bp_name'),['id'=>'assigned_bp_name','prompt'=>'']) ?> 

    <?= $form->field($model, 'assigned_bp_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assigned_sp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assigned_sp_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sp_quotation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'negotiated_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_agreed_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'demurrage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sp_service_charge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'psl_service_charge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_invoice_amount')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'customer_level')->dropDownList( ArrayHelper::map(CustomerLevel::find()->all(), 'level', 'level'),['prompt'=>'']) ?> 

    <?//= $form->field($model, 'dialer_id')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
