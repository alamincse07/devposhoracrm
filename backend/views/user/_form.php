<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\BpList;
use app\models\CsoList;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'user_level')->dropDownList([ 'supadmin' => 'Supadmin', 'bp' => 'BP', 'cso' => 'CSO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
      
     <?= $form->field($model, 'status')->dropDownList([ 10 => 'Active', 0 => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'bp_id')->dropDownList( ArrayHelper::map(BpList::find()->all(), 'id', 'bp_name'),['prompt'=>'']) ?>
     <?= $form->field($model, 'cso_id')->dropDownList( ArrayHelper::map(CsoList::find()->all(), 'id', 'cso_name'),['prompt'=>'']) ?> 

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
