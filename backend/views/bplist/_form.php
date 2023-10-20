<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Zone;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\BpList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bp-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

   
<?= $form->field($model, 'zone')->dropDownList( ArrayHelper::map(Zone::find()->all(), 'id', 'name'),['prompt'=>'']) ?> 
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
