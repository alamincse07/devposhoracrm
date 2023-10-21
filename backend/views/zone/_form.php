<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\City;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Zone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zone-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'city_id')->dropDownList( ArrayHelper::map(City::find()->all(), 'id', 'name'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
