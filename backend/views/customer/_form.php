<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker; 
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

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
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>


     <?= $form->field($model, 'call_number_source')->dropDownList( ArrayHelper::map(CallNumberSource::find()->all(), 'source', 'source'),['prompt'=>'']) ?>


    
      <?= $form->field($model, 'customers_type')->dropDownList( ArrayHelper::map(ClientType::find()->all(), 'type', 'type'),['prompt'=>'']) ?> 


    <?= $form->field($model, 'customers_categories')->dropDownList( ArrayHelper::map(CustomersCategories::find()->orderBy(['category' => SORT_ASC])->all(), 'category', 'category'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'city')->dropDownList( ArrayHelper::map(City::find()->all(), 'name', 'name'),['id'=>'city','prompt'=>'']) ?> 
             
             <?= $form->field($model, 'zone')->dropDownList( ArrayHelper::map(Zone::find()->all(), 'name', 'name'),['id'=>'zone','prompt'=>'']) ?> 
             
               <?= $form->field($model, 'location')->dropDownList( ArrayHelper::map(Location::find()->all(), 'name', 'name'),['id'=>'location','prompt'=>'']) ?> 

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_install')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'customer_level')->textInput(['maxlength' => true]) ?>


    <?//= $form->field($model, 'added_by')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'edit_date')->textInput() ?>

    <?//= $form->field($model, 'edit_by')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'added_date')->hiddenInput(['value'=> date('Y-m-d')])->label(false); ?>
         <?= $form->field($model, 'added_by')->hiddenInput(['value'=> Yii::$app->apu->sesdata('username')])->label(false); ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
