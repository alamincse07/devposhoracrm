<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ServiceCategory;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceLines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-lines-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'category_id')->dropDownList( ArrayHelper::map(ServiceCategory::find()->all(), 'id', 'category'),['prompt'=>'']) ?> 

    <?= $form->field($model, 'lines')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
