<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Sales Reports';
?>
<div class="site-index">
<?php $form = ActiveForm::begin(['options' => ['method' => 'post']]) ?>

       <div class="box box-default box-solid">
 <div class="box-body">
 <div class="row">
      <div class="col-md-3">	
 
            <strong>Select From:</strong>&nbsp;&nbsp;
			<?= yii\jui\DatePicker::widget(['name' => 'start_date', 'clientOptions' => ['defaultDate' => 'php:Y-m-d'], 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d',]) ?>
               </div>
		  <div class="col-md-3">	
      <strong>Select To:</strong>&nbsp;&nbsp;<?= yii\jui\DatePicker::widget(['name' => 'end_date', 'clientOptions' => ['defaultDate' => 'php:Y-m-d'], 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d',]) ?>  
 
   </div>
             </div><br>
<br>

             
           <div class="row">
      <div class="col-md-12">	  
      
       <input type="submit" class="btn btn-primary" value="Sales Status" name="salesstatus">&nbsp;&nbsp;&nbsp;
       
       
      </div>
             
             
                 </div>
                     </div>

      <?php ActiveForm::end(); ?>
</div>
