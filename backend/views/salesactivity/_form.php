<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker; 
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use app\models\OrderGateway;
use app\models\ServiceLines;
use app\models\ServiceCategory;
use app\models\Status;
use app\models\SalesCategory;
use app\models\ModeOfPayment;
use app\models\AssainedPerson;

/* @var $this yii\web\View */
/* @var $model app\models\SalesActivity */
/* @var $form yii\widgets\ActiveForm */

$sesdb =  Yii::$app->apu->sesdata('username');
?>
<script type="text/javascript">
function findTotal(){
	
	
	//ssl
     
    var invoice_bill = parseFloat(document.getElementById('invoice_bill').value);
	
	var sslch= (invoice_bill*2.5)/100;	
	var sslchcal = Math.round(sslch);
	
	var ssl_charge = document.getElementById('ssl_charge');
 		ssl_charge.value = sslchcal ;
//vat

	var vatcal= ((invoice_bill/100.89)*0.89);	
	var vatcalc = Math.ceil(vatcal);
	
	var vat = document.getElementById('vat');
 		vat.value = vatcalc ;
//service_charge
var scharge = invoice_bill-vatcalc;
	var service_charge = document.getElementById('service_charge');
 		service_charge.value = scharge ;	
//ssl_charge_factoring
var sslfac = Math.round(scharge/102.7*2.7);
var ssl_charge_factoring = document.getElementById('ssl_charge_factoring');
ssl_charge_factoring.value = sslfac ;	
  
 //poshora_charge
 var additional_received = parseFloat(document.getElementById('additional_received').value);
 var pocha = Math.round((scharge-sslfac)/110*10+additional_received);
 var poshora_charge = document.getElementById('poshora_charge');
poshora_charge.value = pocha ;	

//sp_service_charges
 var sp_spare_parts = parseFloat(document.getElementById('sp_spare_parts').value);
 var sp_discount_demurrage = parseFloat(document.getElementById('sp_discount_demurrage').value);
 var spsecha = Math.round((scharge-sslfac)-pocha+sp_spare_parts-sp_discount_demurrage);
 var sp_service_charges = document.getElementById('sp_service_charges');
sp_service_charges.value = spsecha ;

//poshora_received
var poshora_spare_parts = parseFloat(document.getElementById('poshora_spare_parts').value);
 var poshora_discount_demurrage = parseFloat(document.getElementById('poshora_discount_demurrage').value);
 var deduction_vat = parseFloat(document.getElementById('deduction_vat').value);
 var deduction_ait = parseFloat(document.getElementById('deduction_ait').value);
 var posrec = vatcalc+sslfac+pocha+poshora_spare_parts-poshora_discount_demurrage-deduction_vat-deduction_ait;
 var poshora_received = document.getElementById('poshora_received');
poshora_received.value = posrec ;

//net_bill_claimed
var netbill = invoice_bill+sp_spare_parts+poshora_spare_parts-poshora_discount_demurrage;
 var net_bill_claimed = document.getElementById('net_bill_claimed');
net_bill_claimed.value = netbill ; 

//net_paid
var netpaid = netbill-deduction_vat-deduction_ait;
 var net_paid = document.getElementById('net_paid');
net_paid.value = netpaid ; 
  		
}


</script>
<div class="sales-activity-form">

    <?php $form = ActiveForm::begin(); ?>
    
    
    <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
         
            <div class="box-body ">
         <?= $form->field($model, 'added_by')->hiddenInput(['value' => $model->isNewRecord ? $sesdb : $model->added_by])->label(false); ?>
        <?= $form->field($model, 'added_date')->hiddenInput(['value'=> $model->isNewRecord ? date('Y-m-d') : $model->added_date])->label(false); ?>
        
          <?= $form->field($model, 'edit_by')->hiddenInput(['value'=>$sesdb])->label(false); ?>
        <?= $form->field($model, 'edit_date')->hiddenInput(['value'=> date('Y-m-d')])->label(false); ?>
        
             <?= $form->field($model, 'customer_id')->textInput(['readonly' => true, 'value' => $model->isNewRecord ? $todel->id : $model->customer_id]) ?>
             
             <?= $form->field($model, 'company_name_b2b')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->company_name : $model->company_name_b2b]) ?>
    

    <?= $form->field($model, 'customer_name')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->customer_name : $model->customer_name]) ?>

    <?= $form->field($model, 'customer_mobile')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->contact_number : $model->customer_mobile]) ?>


    <?= $form->field($model, 'customer_email')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->email : $model->customer_email]) ?>


    <?= $form->field($model, 'customer_address')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->address : $model->customer_address]) ?>

     <?= $form->field($model, 'city')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->city : $model->city]) ?>

      <?= $form->field($model, 'zone')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->zone : $model->zone]) ?>

    <?= $form->field($model, 'location')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->location : $model->location]) ?>
    <?= $form->field($model, 'address')->textInput(['readonly' => false, 'value' => $model->isNewRecord ? $todel->address : $model->address]) ?>
           
         
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col (left) -->
          <div class="col-md-6">
          <div class="box box-solid">
           
            <div class="box-body ">
          	  <?= $form->field($model, 'invoice_no')->textInput(['maxlength' => true]) ?>

      <?= ''.$form->field($model,'invoice_date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>

     <?= $form->field($model, 'sales_catagories')->dropDownList( ArrayHelper::map(SalesCategory::find()->all(), 'category', 'category'),['prompt'=>'']) ?> 
     
 <?= $form->field($model, 'sales_status')->dropDownList( ArrayHelper::map(Status::find()->all(), 'status', 'status'),['prompt'=>'']) ?> 

     <?= $form->field($model, 'service_order_gateway')->dropDownList( ArrayHelper::map(OrderGateway::find()->all(), 'gateway', 'gateway'),['prompt'=>'']) ?> 


     <?= ''.$form->field($model,'service_date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>

  
      <?= $form->field($model, 'services_category')->dropDownList( ArrayHelper::map(ServiceCategory::find()->orderBy(['category' => SORT_ASC])->all(), 'id', 'category'),['id'=>'sc','prompt'=>'']) ?> 
      
        <?
					echo $form->field($model, 'services_line')->widget(DepDrop::classname(), [
					'options'=>['id'=>'sl'],
					'pluginOptions'=>[
						'depends'=>['sc'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['/site/servicelines'])
					]
				]);
			
			?>

  

    <?= $form->field($model, 'sp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sp_cell_number')->textInput(['maxlength' => true]) ?>
          

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      
      </div>
    
    
    <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
         
            <div class="box-body ">
        
 <?= $form->field($model, 'mode_of_payments')->dropDownList( ArrayHelper::map(ModeOfPayment::find()->all(), 'payment_mode', 'payment_mode'),['prompt'=>'']) ?> 
  
  <?= $form->field($model, 'receiver_name')->dropDownList( ArrayHelper::map(AssainedPerson::find()->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'),['id'=>'sc','prompt'=>'']) ?> 
  
    <?= $form->field($model, 'field_representative')->dropDownList( ArrayHelper::map(AssainedPerson::find()->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'),['id'=>'sc','prompt'=>'']) ?> 
    <?= $form->field($model, 'name_of_representative')->dropDownList( ArrayHelper::map(AssainedPerson::find()->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'),['id'=>'sc','prompt'=>'']) ?> 
    <?//= $form->field($model, 'name_of_representative')->textInput(['maxlength' => true]) ?>
    
    <?= ''.$form->field($model,'poshora_received_date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>

      
    <?= $form->field($model, 'invoice_bill')->textInput(['maxlength' => true, 'id' => 'invoice_bill', 'onblur' => 'js:findTotal();' ]) ?>

   
    <?= $form->field($model, 'ssl_charge')->textInput(['maxlength' => true, 'id' => 'ssl_charge']) ?>

     <?= $form->field($model, 'vat')->textInput(['maxlength' => true, 'id' => 'vat']) ?>

    <?= $form->field($model, 'service_charge')->textInput(['maxlength' => true, 'id' => 'service_charge']) ?>

    <?= $form->field($model, 'ssl_charge_factoring')->textInput(['maxlength' => true, 'id' => 'ssl_charge_factoring']) ?>

    <?= $form->field($model, 'poshora_charge')->textInput(['maxlength' => true, 'id' => 'poshora_charge']) ?>

    <?= $form->field($model, 'sp_service_charges')->textInput(['maxlength' => true, 'id' => 'sp_service_charges']) ?>

    <?= $form->field($model, 'poshora_received')->textInput(['maxlength' => true, 'id' => 'poshora_received']) ?>
      <?= $form->field($model, 'additional_received')->textInput(['maxlength' => true, 'id' => 'additional_received', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->additional_received]) ?>
      
      <?= $form->field($model, 'sp_spare_parts')->textInput(['maxlength' => true, 'id' => 'sp_spare_parts', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->sp_spare_parts]) ?>


    <?= $form->field($model, 'sp_discount_demurrage')->textInput(['maxlength' => true, 'id' => 'sp_discount_demurrage', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->sp_discount_demurrage]) ?>

   <?//= $form->field($model, 'sp_spare_parts')->textInput(['maxlength' => true, 'id' => 'sp_spare_parts', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->sp_spare_parts]) ?>

  
<?= $form->field($model, 'poshora_spare_parts')->textInput(['maxlength' => true, 'id' => 'poshora_spare_parts', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->poshora_spare_parts]) ?>

<?= $form->field($model, 'poshora_discount_demurrage')->textInput(['maxlength' => true, 'id' => 'poshora_discount_demurrage', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->poshora_discount_demurrage]) ?>

    <?= $form->field($model, 'net_bill_claimed')->textInput(['maxlength' => true, 'id' => 'net_bill_claimed']) ?>
<?= $form->field($model, 'deduction_vat')->textInput(['maxlength' => true, 'id' => 'deduction_vat', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->deduction_vat]) ?>
   
<?= $form->field($model, 'deduction_ait')->textInput(['maxlength' => true, 'id' => 'deduction_ait', 'onblur' => 'js:findTotal();','value' => $model->isNewRecord ? 0 : $model->deduction_ait]) ?>
    

    <?= $form->field($model, 'net_paid')->textInput(['maxlength' => true, 'id' => 'net_paid']) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
         
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col (left) -->
          
     
      
      </div>
    


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
