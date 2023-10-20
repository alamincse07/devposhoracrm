<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'CSO Reports';
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
      
       <input type="submit" class="btn btn-primary" value="CSO Individual Call and SMQ Status" name="callsmqstatus">&nbsp;&nbsp;&nbsp;
       <input type="submit" class="btn btn-primary" value="CSO Individual Sales Status" name="salesstatus">&nbsp;&nbsp;&nbsp;
       <input type="submit" class="btn btn-primary" value="CSO Service Status" name="servicestatus">&nbsp;&nbsp;&nbsp;
       <input type="submit" class="btn btn-primary" value="CSO Social Media Query Status" name="socialmedia">&nbsp;&nbsp;&nbsp;
        <input type="submit" class="btn btn-info" value="CSO Activity Download" name="csodata">&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;
        <input type="submit" class="btn btn-warning" value="Social Media Data Download" name="socialdata">&nbsp;&nbsp;&nbsp;
      
      </div>
             
             
                 </div>
                     </div>

      <?php ActiveForm::end(); ?>
</div>
