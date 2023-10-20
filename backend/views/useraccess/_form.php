<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\UserAccess */
/* @var $form yii\widgets\ActiveForm */
$wd = array('Sunday'=>'Sunday', 
						  'Monday'=>'Monday',
							'Tuesday'=>'Tuesday',
							'Wednesday'=>'Wednesday',
							'Thursday'=>'Thursday',
							'Friday'=>'Friday',
							'Saturday'=>'Saturday',
						);
?>

<div class="user-access-form">

    <?php $form = ActiveForm::begin(); ?>


     <?= $form->field($model, 'user_id')->dropDownList( ArrayHelper::map(User::find()->all(), 'id', 'username'),['prompt'=>'']) ?>

    <?//= $form->field($model, 'cname')->textInput(['maxlength' => true]) ?>
    
    <table width="100%" border="0" cellspacing="2" cellpadding="5">
 <tbody>
  <tr><td width="40%"><input type="checkbox" name="cname[]" value="action">&nbsp;&nbsp;<strong>Action</strong></td><td width="60%"><input type="radio" name="action_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="action_a" value="view"> View</td></tr>
  <tr><td width="40%"><input type="checkbox" name="cname[]" value="assainedperson">&nbsp;&nbsp;<strong>Assained Person</strong></td><td width="60%"><input type="radio" name="assainedperson_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="assainedperson_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="assignedactivities">&nbsp;&nbsp;<strong>Assigned Activities</strong></td><td width="60%"><input type="radio" name="assignedactivities_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="assignedactivities_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="bplist">&nbsp;&nbsp;<strong>BP List</strong></td><td width="60%"><input type="radio" name="bplist_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="bplist_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="csolist">&nbsp;&nbsp;<strong>CSO List</strong></td><td width="60%"><input type="radio" name="csolist_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="csolist_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="callnumbersource">&nbsp;&nbsp;<strong>Call Number Source</strong></td><td width="60%"><input type="radio" name="callnumbersource_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="callnumbersource_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="calltype">&nbsp;&nbsp;<strong>Call Type</strong></td><td width="60%"><input type="radio" name="calltype_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="calltype_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="clienttype">&nbsp;&nbsp;<strong>Client Type</strong></td><td width="60%"><input type="radio" name="clienttype_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="clienttype_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="customerlevel">&nbsp;&nbsp;<strong>Customer Level</strong></td><td width="60%"><input type="radio" name="customerlevel_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="customerlevel_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="customerscategories">&nbsp;&nbsp;<strong>Customers Categories</strong></td><td width="60%"><input type="radio" name="customerscategories_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="customerscategories_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="dailystatus">&nbsp;&nbsp;<strong>Daily Status</strong></td><td width="60%"><input type="radio" name="dailystatus_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="dailystatus_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="jobtype">&nbsp;&nbsp;<strong>Job Type</strong></td><td width="60%"><input type="radio" name="jobtype_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="jobtype_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="ordergateway">&nbsp;&nbsp;<strong>Order Gateway</strong></td><td width="60%"><input type="radio" name="ordergateway_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="ordergateway_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="querystatus">&nbsp;&nbsp;<strong>Query Status</strong></td><td width="60%"><input type="radio" name="querystatus_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="querystatus_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="status">&nbsp;&nbsp;<strong>Status</strong></td><td width="60%"><input type="radio" name="status_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="status_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="city">&nbsp;&nbsp;<strong>City</strong></td><td width="60%"><input type="radio" name="city_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="city_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="zone">&nbsp;&nbsp;<strong>Zone</strong></td><td width="60%"><input type="radio" name="zone_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="zone_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="location">&nbsp;&nbsp;<strong>Location</strong></td><td width="60%"><input type="radio" name="location_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="location_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="servicecategory">&nbsp;&nbsp;<strong>Service Category</strong></td><td width="60%"><input type="radio" name="servicecategory_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="servicecategory_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="servicelines">&nbsp;&nbsp;<strong>Servicelines</strong></td><td width="60%"><input type="radio" name="servicelines_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="servicelines_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="socialmediacategory">&nbsp;&nbsp;<strong>SocialMedia Category</strong></td><td width="60%"><input type="radio" name="socialmediacategory_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="socialmediacategory_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="bpactivity">&nbsp;&nbsp;<strong>BP Activity</strong></td><td width="60%"><input type="radio" name="bpactivity_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="bpactivity_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="csoactivity">&nbsp;&nbsp;<strong>CSO Activity</strong></td><td width="60%"><input type="radio" name="csoactivity_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="csoactivity_a" value="view"> View</td></tr>
<tr><td width="40%"><input type="checkbox" name="cname[]" value="socialmediaquery">&nbsp;&nbsp;<strong>Social Media Query</strong></td><td width="60%"><input type="radio" name="socialmediaquery_a" value="all"> All&nbsp;&nbsp;<input type="radio" name="socialmediaquery_a" value="view"> View</td></tr>

 </tbody>
</table>


    <?//= $form->field($model, 'actions')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
