<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker; 
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

use app\models\Action;
use app\models\AssainedPerson;
use app\models\AssignedActivities;

use app\models\BpList;
use app\models\CallNumberSource;
use app\models\CallType;
use app\models\City;
use app\models\ClientType;
use app\models\CsoActivity;
use app\models\BpActivity;
use app\models\Customer;
use app\models\CustomerLevel;
use app\models\CustomersCategories;
use app\models\DailyStatus;
use app\models\JobType;
use app\models\Location;
use app\models\OrderGateway;
use app\models\QueryStatus;
use app\models\Status;
use app\models\Zone;
use app\models\ServiceLines;
use app\models\ServiceCategory;

/* @var $this yii\web\View */
/* @var $model app\models\CsoActivity */
/* @var $form yii\widgets\ActiveForm */
$pp = $_REQUEST['phone_number'];
$pchar= strlen($pp);
if($pchar == 13)
{
	$phone = substr($pp, 2);
}elseif($pchar == 10)
{
	$phone = '0'.$pp;
}
else
{
$phone = $pp;	
}

$cso = $_REQUEST['user'];
$recording_filename = $_REQUEST['recording_filename'];

if(isset($_REQUEST['SQLdate'])){
$cdv = explode(' ',$_REQUEST['SQLdate']);	
$SQLdate = $cdv[0];
}
else{
	$SQLdate = date('Y-m-d');
}

$old = Customer::find()->where("contact_number='".$phone."'")->limit(1)->orderBy(['id' => SORT_DESC])->one();
if($old){
$model->client_name=$old->customer_name;
$model->gender = $old->gender;
$model->city = $old->city;
$model->zone = $old->zone;
$model->location = $old->location;
$model->address = $old->address;
$model->call_number_source = $old->call_number_source;
$model->client_type = $old->customers_type;
$model->gender = $old->gender;
$model->customer_level = $old->customer_level;

}
$oldall = CsoActivity::find()->where("contact_number='".$phone."'")->orderBy(['id' => SORT_DESC])->all();
$allsso = BpActivity::find()->where("clients_representative_number='".$phone."'")->orderBy(['id' => SORT_DESC])->all();
?>

<a href="#section1" class="btn btn-primary">Call History</a>
        <a href="#section2" class="btn btn-info">SSO History</a>

    <?php $form = ActiveForm::begin(); ?>
   <div id="section0"></div>   
<table width="100%" align="center" class="table table-bordered">
 <tbody>
  

    
  
     <tr><td width="25%">
			<?= $form->field($model, 'contact_number')->textInput(['maxlength' => true, 'value'=>$phone,'readonly'=> true]) ?>
             
              <?= $form->field($model, 'call_number_source')->dropDownList( ArrayHelper::map(CallNumberSource::find()->all(), 'source', 'source'),['prompt'=>'']) ?> 
              <?= $form->field($model, 'call_type')->dropDownList( ArrayHelper::map(CallType::find()->all(), 'type', 'type'),['prompt'=>'']) ?> 
            
			</td><td width="25%">
            <?= $form->field($model, 'client_name')->textInput(['maxlength' => true, ]) ?>      
            <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other', ], ['prompt' => '']) ?>      
            
            <?= $form->field($model, 'client_type')->dropDownList( ArrayHelper::map(ClientType::find()->all(), 'type', 'type'),['prompt'=>'']) ?> 
    		 
    		
            </td><td width="25%"> 
             <?= $form->field($model, 'city')->dropDownList( ArrayHelper::map(City::find()->all(), 'name', 'name'),['id'=>'city','prompt'=>'']) ?> 
             
             <?= $form->field($model, 'zone')->dropDownList( ArrayHelper::map(Zone::find()->all(), 'name', 'name'),['id'=>'zone','prompt'=>'']) ?> 
             
               <?= $form->field($model, 'location')->dropDownList( ArrayHelper::map(Location::find()->all(), 'name', 'name'),['id'=>'location','prompt'=>'']) ?> 
			 <?
					/*echo $form->field($model, 'zone')->widget(DepDrop::classname(), [
					'options'=>['id'=>'zone'],
					'pluginOptions'=>[
						'depends'=>['city'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['zone'])
					]
				]);*/
			
			?>
            <?
				/*echo $form->field($model, 'location')->widget(DepDrop::classname(), [
				'options'=>['id'=>'location'],
					'pluginOptions'=>[
						'depends'=>['city', 'zone'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['location'])
					]
				]);*/
			
			?>
           
          
            </td><td width="25%"> 			
               <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?> 
             <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?> 
            </td>
            
  </tr> 
    <tr><td>
            
  <?//= $form->field($model, 'service_category')->dropDownList( ArrayHelper::map(ServiceCategory::find()->all(), 'category', 'category'),['id'=>'service_category','prompt'=>'']) ?> 
             <?//= $form->field($model, 'status')->dropDownList( ArrayHelper::map(Status::find()->all(), 'status', 'status'),['prompt'=>'']) ?> 
            
           
               <?
					/*echo $form->field($model, 'assigned_bp_number')->widget(DepDrop::classname(), [
					'options'=>['id'=>'bpn'],
					'pluginOptions'=>[
						'depends'=>['bp'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['bpinfo'])
					]
				]);*/
			
			?>
             
              <?//= $form->field($model, 'negotiated_price')->textInput(['maxlength' => true]) ?>
              <?//= $form->field($model, 'sp_service_charge')->textInput(['maxlength' => true]) ?>
             <?= $form->field($model, 'customer_level')->dropDownList( ArrayHelper::map(CustomerLevel::find()->all(), 'level', 'level'),['prompt'=>'']) ?> 
             
              <?= $form->field($model, 'cso_name')->textInput(['maxlength' => true, 'value'=>$cso,'readonly'=> true]) ?>
             
            </td><td>
             
               <?//= $form->field($model, 'service_line')->dropDownList( ArrayHelper::map(ServiceLines::find()->all(), 'lines', 'lines'),['id'=>'service_line','prompt'=>'']) ?> 
           
               <?
					/*echo $form->field($model, 'service_line')->widget(DepDrop::classname(), [
					'options'=>['id'=>'service_line'],
					'pluginOptions'=>[
						'depends'=>['service_category'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['servicelines'])
					]
				]);*/
			
			?>
          
              <?//= $form->field($model, 'service_order_number')->textInput(['maxlength' => true]) ?>
              <?//= $form->field($model, 'assigned_sp_name')->textInput(['maxlength' => true]) ?>
              <?//= $form->field($model, 'customer_agreed_price')->textInput(['maxlength' => true]) ?>
              <?//= $form->field($model, 'psl_service_charge')->textInput(['maxlength' => true]) ?>
               <?= $form->field($model, 'call_status')->dropDownList(['Interested' => 'Interested',
				'No Answer' => 'No Answer',
				'Busy' => 'Busy',
				'Not Interested' => 'Not Interested',
				'Switched Off' => 'Switched Off',
				'Wrong Number' => 'Wrong Number',], ['prompt' => '']) ?> 
            
            </td><td>
           
             <?//= $form->field($model, 'action')->dropDownList( ArrayHelper::map(Action::find()->all(), 'action', 'action'),['prompt'=>'']) ?> 

              <?//= $form->field($model, 'order_gateway')->dropDownList( ArrayHelper::map(OrderGateway::find()->all(), 'gateway', 'gateway'),['prompt'=>'']) ?> 
             <?//= $form->field($model, 'assigned_sp_number')->textInput(['maxlength' => true]) ?>
             <?//= $form->field($model, 'demurrage')->textInput(['maxlength' => true]) ?>
              <?//= $form->field($model, 'vat')->textInput(['maxlength' => true]) ?>
               <?= $form->field($model, 'call_date')->hiddenInput(['value'=>$SQLdate])->label(false); ?>
              <?= $form->field($model, 'dialer_id')->hiddenInput(['value'=>$recording_filename])->label(false); ?>
              </td><td>
           
              <?//= $form->field($model,'apointment_date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'php:Y-m-d'],'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d']) ?>

              <?//= $form->field($model, 'assigned_bp_name')->dropDownList( ArrayHelper::map(BpList::find()->all(), 'id', 'bp_name'),['id'=>'assigned_bp_name','prompt'=>'']) ?> 
              <?//= $form->field($model, 'sp_quotation')->textInput(['maxlength' => true]) ?>
               <?//= $form->field($model, 'discount_amount')->textInput(['maxlength' => true]) ?>
               <?//= $form->field($model, 'total_invoice_amount')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'call_start_time')->hiddenInput(['value'=> date('Y-m-d H:i:s')])->label(false); ?>
              
            </td>
   </tr>
    <tr>
     <td colspan="4" align="center" valign="middle"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></td>
    </tr>

  
    
 </tbody>
</table>

    <?php ActiveForm::end(); ?>
    <p>&nbsp;</p>
  <?
  	if($oldall){
  ?> 
  <div id="section1">
  <h3>Call History</h3> <br>

    <table width="100%" class="table table-bordered">
     
      <tr>
        <td width="4%" bgcolor="#82ECA1"><strong>SL</strong></td>
        <td width="16%" bgcolor="#82ECA1"><strong>Call  info</strong></td>
        <td width="16%" bgcolor="#82ECA1"><strong>Customer  info</strong></td>
        <td width="16%" bgcolor="#82ECA1"><strong>Service  info</strong></td>
        <td width="15%" bgcolor="#82ECA1"><strong>Order  info</strong></td>
        <td width="16%" bgcolor="#82ECA1"><strong>Payment  info</strong></td>
        <td width="16%" bgcolor="#82ECA1"><strong>Notes</strong></td>
      </tr>
      <? $i=0;
	  	foreach($oldall as $data){
			$i++;
			//$cdv = explode(' ',$data->call_date);
		?>
      <tr>
        <td align="left" valign="top"><?=$i?></td>
        <td align="left" valign="top">
        Call Date: <strong><? $postdate = new DateTime($data->call_date); echo $postdate->format('d-m-Y');?></strong><br>
        CSO: <strong><?=$data->cso_name;?></strong><br>
        Call Source: <strong><?=$data->call_number_source;?></strong><br>
        Call Status: <strong><?=$data->call_status;?></strong><br>
        Call Type: <strong><?=$data->call_type;?></strong></td>
        <td align="left" valign="top">
		Name: <strong><?=$data->client_name?></strong><br>
        Phone: <strong><?=$data->contact_number?></strong><br>
        Type: <strong><?=$data->client_type?></strong><br>
        Level: <strong><?=$data->customer_level?></strong></td>
        <td align="left" valign="top">
		<? if($data->service_category){ ?>Category: <strong><?=$data->service_category?></strong><br><? } ?>
        <? if($data->service_line){ ?>Line: <strong><?=$data->service_line?></strong><br><? } ?>
        <? if($data->action){ ?>Action: <strong><?=$data->action?></strong> <br><? } ?>
        <? if($data->apointment_date){ ?>Apointment Date: <strong><? $postdate = new DateTime($data->apointment_date); echo $postdate->format('d-m-Y');?></strong><br> <? } ?>
        Status: <strong><?=$data->status?></strong></td>
        <td align="left" valign="top">
        <? if($data->service_order_number){ ?>Order Number: <strong><?=$data->service_order_number?></strong><br><? } ?>		
        <? if($data->order_gateway){ ?>Gateway: <strong><?=$data->order_gateway?></strong><br><? } ?>
        <? if($data->assigned_bp_name){ ?>SSR: <strong><?=$data->assigned_bp_name?></strong><br><? } ?>
        <? if($data->assigned_bp_number){ ?>SSR Phone: <strong><?=$data->assigned_bp_number?></strong><br><? } ?>
        <? if($data->assigned_sp_name){ ?>SP: <strong><?=$data->assigned_sp_name?></strong><br><? } ?>
        <? if($data->assigned_sp_number){ ?>Sp Phone: <strong><?=$data->assigned_sp_number?></strong><? } ?>
        </td>
        <td align="left" valign="top">
		<? if($data->sp_quotation){ ?>SP Quote: <strong><?=$data->sp_quotation?></strong><br><? } ?>
        <? if($data->negotiated_price){ ?>Negotiated Price: <strong><?=$data->negotiated_price?></strong><br><? } ?>
        <? if($data->customer_agreed_price){ ?>Customer Agreed: <strong><?=$data->customer_agreed_price?></strong><br><? } ?>
        <? if($data->demurrage){ ?>Demurrage: <strong><?=$data->demurrage?></strong><br><? } ?>
        <? if($data->discount_amount){ ?>Discount: <strong><?=$data->discount_amount?></strong><br><? } ?>
        <? if($data->sp_service_charge){ ?>SP Charge: <strong><?=$data->sp_service_charge?></strong><br><? } ?>
        <? if($data->psl_service_charge){ ?>PSL Charge: <strong><?=$data->psl_service_charge?></strong><br><? } ?>
        <? if($data->vat){ ?>VAT: <strong><?=$data->vat?></strong><br><? } ?>
        <? if($data->total_invoice_amount){ ?>Total Amount: <strong><?=$data->total_invoice_amount?></strong><? } ?>
        
        </td>
        <td align="left" valign="top"><?=$data->notes?></td>
      </tr>
      <? } ?>
    </table>
    </div>
    <a href="#section0" class="btn btn-warning">Top</a>
<? } ?>

  <p>&nbsp;</p>
  <?
  	if($allsso){
  ?> 
<div id="section2">
  <h3>SSO History</h3> <br>

    <table width="100%" class="table table-bordered">
     
      <tr>
        <td width="4%" bgcolor="#4BE9E2"><strong>SL</strong></td>
        <td width="23%" bgcolor="#4BE9E2"><strong>Customer  info</strong></td>
        <td width="24%" bgcolor="#4BE9E2"><strong>Customers Categories</strong></td>
        <td width="15%" bgcolor="#4BE9E2"><strong>Location Details</strong></td>
        <td width="18%" bgcolor="#4BE9E2"><strong>Query Status</strong></td>
        <td width="16%" bgcolor="#4BE9E2"><strong>Notes</strong></td>
     </tr>
      <? $i=0;
	  	foreach($allsso as $adata){
			$i++;
			//$cdv = explode(' ',$data->call_date);
		
			
			
		?>
      <tr>
        <td align="left" valign="top"><?=$i?></td>
       <td align="left" valign="top"><strong>Date:</strong>
        <? $postdate = new DateTime($adata->date); echo $postdate->format('d-m-Y');?>
        <br>
        <strong>Name:</strong> <?=$adata->clients_representative_name;?><br>
       <strong> Contact Number: </strong><?=$adata->clients_representative_number;?><br>
        <strong>Company Name:</strong> <?=$adata->company_name;?>
<br>
      <strong> Apps Installed:</strong> <?=$adata->apps_installed;?></td>
        <td align="left" valign="top"><strong>Customer Category: </strong><?=$adata->customers_categories;?><br>
         <strong>Assigned Activities: </strong><?=$adata->assigned_activities;?><br>
         <strong>Job Type: </strong><?=$adata->job_type;?></td>
        <td align="left" valign="top"><strong>City:</strong> <? 	if($adata->city){	$zz = City::findOne($adata->city);  echo $zz->name;	}?><br>
        <strong> Zone:</strong> <? if($adata->zone){$zz = Zone::findOne($adata->zone);	echo $zz->name;	}?><br>
     
         <strong>Address:</strong> <?=$adata->address;?></td>
        <td align="left" valign="top"><strong>Query Status: </strong><?=$adata->query_status;?><br>
         <strong>Service Category: </strong><? if($adata->service_category){$zz = ServiceCategory::findOne($adata->service_category);	echo $zz->category;	}?><br>
        <strong> Service Line: </strong><? if($adata->service_line){$zz = ServiceLines::findOne($adata->service_line);	echo $zz->lines;	}?><br>
         <strong>SSO Name: </strong><?=$adata->bp_name;?>
<br>
        </td>
        <td align="left" valign="top"><?=$adata->notes;?></td>
      </tr>
      <? } ?>
    </table>
</div>
    <a href="#section0" class="btn btn-warning">Top</a>
<? } ?>

