<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\City;
use app\models\Zone;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>


 <?= $form->field($model, 'city_id')->dropDownList( ArrayHelper::map(City::find()->all(), 'id', 'name'),['id'=>'city','prompt'=>'']) ?> 
 
 <?
		echo $form->field($model, 'zone_id')->widget(DepDrop::classname(), [
    'options'=>['id'=>'zone'],
    'pluginOptions'=>[
        'depends'=>['city'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/site/zone'])
    ]
]);
	
	?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
