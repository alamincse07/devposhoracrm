<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker; 

use app\models\CsoList;
use app\models\CallNumberSource;

/* @var $this yii\web\View */
/* @var $model app\models\CsoCallSourceTarget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cso-call-source-target-form">

    <?php $form = ActiveForm::begin(); ?>


    

  <?= $form->field($model,'target_from')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>

  <?= $form->field($model,'target_to')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>


    <?//= $form->field($model, 'target_daterange')->textInput(['maxlength' => true]) ?>


     <?= $form->field($model, 'cso_id')->dropDownList( ArrayHelper::map(CsoList::find()->all(), 'id', 'cso_name'),['prompt'=>'']) ?>


     <?= $form->field($model, 'call_source')->dropDownList( ArrayHelper::map(CallNumberSource::find()->all(), 'source', 'source'),['prompt'=>'']) ?>

    <?= $form->field($model, 'target')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
