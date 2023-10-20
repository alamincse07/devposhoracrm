<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker; 

use app\models\BpList;

/* @var $this yii\web\View */
/* @var $model app\models\SsrTarget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ssr-target-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model,'target_from')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>

  <?= $form->field($model,'target_to')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>
    <?//= $form->field($model, 'target_daterange')->textInput(['maxlength' => true]) ?>

  
     <?= $form->field($model, 'ssr_id')->dropDownList( ArrayHelper::map(BpList::find()->all(), 'id', 'bp_name'),['prompt'=>'']) ?>

    <?= $form->field($model, 'spot_sales_target')->textInput() ?>

    <?= $form->field($model, 'spot_sales_amount_target')->textInput() ?>

    <?= $form->field($model, 'sp_sourcing_in_hand_target')->textInput() ?>

    <?= $form->field($model, 'client_visit_for_service_assess_target')->textInput() ?>

    <?= $form->field($model, 'client_visit_during_service_target')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
