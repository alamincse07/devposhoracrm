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
use app\models\BpActivity;
use app\models\BpList;
use app\models\CallNumberSource;
use app\models\CallType;
use app\models\City;
use app\models\ClientType;

use app\models\CustomerLevel;
use app\models\CustomersCategories;
use app\models\DailyStatus;
use app\models\JobType;
use app\models\Location;
use app\models\OrderGateway;
use app\models\QueryStatus;
use app\models\Status;
use app\models\Zone;
use app\models\ServiceCategory;

/* @var $this yii\web\View */
/* @var $model app\models\BpActivity */
/* @var $form yii\widgets\ActiveForm */

$sesdb =  Yii::$app->apu->sesdata('bp_id');
if($sesdb >0)
{
	$bp = BpList::findOne($sesdb);	
	 $bp_name = $bp->bp_name;
}
else
{
	 $bp_name = 'supadmin';
}

$wd = array('Sunday'=>'Sunday', 
						  'Monday'=>'Monday',
							'Tuesday'=>'Tuesday',
							'Wednesday'=>'Wednesday',
							'Thursday'=>'Thursday',
							'Friday'=>'Friday',
							'Saturday'=>'Saturday',
						);


?>

<div class="bp-activity-form">

    <?php $form = ActiveForm::begin();  ?>


      <?= $form->field($model, 'bp_id')->hiddenInput(['value'=>$sesdb])->label(false); ?>
        <?= $form->field($model, 'bp_name')->hiddenInput(['value'=> $bp_name])->label(false); ?>
        <?= $form->field($model, 'assigned_person')->hiddenInput(['value'=> $bp_name])->label(false); ?>

<?//= $form->field($model, 'assigned_person')->dropDownList( ArrayHelper::map(AssainedPerson::find()->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'),['prompt'=>'']) ?> 

  <?= ''.$form->field($model,'date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>


     <?//= $form->field($model, 'week_day')->dropDownList($wd,['prompt'=>'']) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clients_representative_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clients_representative_number')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'customer_email')->textInput(['maxlength' => true]) ?>
    
 <?//= $form->field($model, 'work_start_time')->widget(\pheme\jui\DateTimePicker::className(), ['timeOnly' => false, 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d H:i']) ?>
 
 <b>Work Start Time:</b>
<?
if($model->work_start_time)
{
	$qdt = str_replace(' ','T', $model->work_start_time);		
}
else
{
	$qdt = '';
}
?>
<input name="qdate" type="datetime-local" autofocus required="required" class="form-control" id="qdate" value="<?=$qdt;?>">


   <?//= $form->field($model, 'work_end_time')->widget(\pheme\jui\DateTimePicker::className(), ['timeOnly' => false, 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d H:i']) ?>
   
    <b>Work End Time:</b>
 <?
if($model->work_end_time)
{
	$rdt = str_replace(' ','T', $model->work_end_time);		
}
else
{
	$rdt = '';
}
?>
<input name="rdate" type="datetime-local" autofocus required="required" class="form-control" id="rdate" value="<?=$rdt;?>">
  


    <?//= $form->field($model, 'work_duration')->textInput(['maxlength' => true]) ?>


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

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'daily_status')->dropDownList( ArrayHelper::map(DailyStatus::find()->orderBy(['status' => SORT_ASC])->all(), 'status', 'status'),['prompt'=>'']) ?> 
 <?= $form->field($model, 'assigned_activities')->dropDownList( ArrayHelper::map(AssignedActivities::find()->orderBy(['activity' => SORT_ASC])->all(), 'activity', 'activity'),['prompt'=>'']) ?> 
    <?= $form->field($model, 'job_type')->dropDownList( ArrayHelper::map(JobType::find()->orderBy(['type' => SORT_ASC])->all(), 'type', 'type'),['prompt'=>'']) ?> 
<?= $form->field($model, 'customers_categories')->dropDownList( ArrayHelper::map(CustomersCategories::find()->orderBy(['category' => SORT_ASC])->all(), 'category', 'category'),['prompt'=>'']) ?> 
    <?= $form->field($model, 'query_status')->dropDownList( ArrayHelper::map(QueryStatus::find()->orderBy(['status' => SORT_ASC])->all(), 'status', 'status'),['prompt'=>'']) ?> 



    
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

    <?= $form->field($model, 'leaflet_distribution_number')->textInput() ?>

    <?= $form->field($model, 'apps_installed')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

  <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?> 
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
