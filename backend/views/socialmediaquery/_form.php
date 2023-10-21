<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker; 
use app\models\CsoList;
use app\models\SocialMediaCategory;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\ServiceCategory;
/* @var $this yii\web\View */
/* @var $model app\models\SocialMediaQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-media-query-form">

    <?php $form = ActiveForm::begin(); ?>
<?//= $form->field($model, 'query_datetime')->widget(\pheme\jui\DateTimePicker::className(), ['timeOnly' => false, 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d H:i']) ?>
<?//= $form->field($model, 'query_datetime')->hiddenInput(['value'=>date('Y-m-d')])->label(false); ?>

<b>Query Date & Time:</b>
<?
if($model->query_datetime)
{
	$qdt = str_replace(' ','T', $model->query_datetime);		
}
else
{
	$qdt = '';
}
?>
<input name="qdate" type="datetime-local" autofocus required="required" class="form-control" id="qdate" value="<?=$qdt;?>">


<?//= $form->field($model, 'response_datetime')->widget(\pheme\jui\DateTimePicker::className(), ['timeOnly' => false, 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d H:i']) ?>
<?//= $form->field($model, 'response_datetime')->hiddenInput(['value'=>date('Y-m-d')])->label(false); ?>

 <?//= $form->field($model, 'response_time_duration')->textInput(['maxlength' => true]) ?>
 
 <b>Response Date & Time:</b>
 <?
if($model->response_datetime)
{
	$rdt = str_replace(' ','T', $model->response_datetime);		
}
else
{
	$rdt = '';
}
?>
<input name="rdate" type="datetime-local" autofocus required="required" class="form-control" id="rdate" value="<?=$rdt;?>">
  

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'query_type')->dropDownList([ 'Messenger' => 'Messenger', 'Comment' => 'Comment',  ], ['prompt' => '']) ?>

      <?= $form->field($model, 'query_details')->textarea(['rows' => 6]) ?> 


      <?= $form->field($model, 'category')->dropDownList( ArrayHelper::map(SocialMediaCategory::find()->all(), 'category', 'category'),['prompt'=>'']) ?>

    <?= $form->field($model, 'hide_del_ban')->dropDownList([ 'Hide' => 'Hide', 'Delete' => 'Delete', 'Ban' => 'Ban', ], ['prompt' => '']) ?>

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


    <?= $form->field($model, 'cso_name')->dropDownList( ArrayHelper::map(CsoList::find()->all(), 'cso_name', 'cso_name'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'media')->dropDownList([ 'Facebook' => 'Facebook', 'Twitter' => 'Twitter', 'Linkedin' => 'Linkedin', 'Youtube' => 'Youtube', 'Instagram' => 'Instagram' , 'WhatsApp' => 'WhatsApp' ], ['prompt' => '']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
