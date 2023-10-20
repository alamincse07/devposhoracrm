<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\CsoActivity;


//$this->title = 'CSO Individual Call and SMQ Status';
$target_daterange = $target_from.' '.$target_to;

$connection = \Yii::$app->db;	
 $dat = $connection->createCommand("SELECT * FROM cso_activity  where call_date between '".$target_from."' and '".$target_to."' order by id DESC")->queryAll();
?>
<div class="site-index">
<strong>CSO Activities</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>

<table border="1" cellpadding="0" cellspacing="0">
 
 <tr>
  <td><strong>#</strong></td>
  <td><strong>Call Number Source</strong></td>
  <td><strong>Contact Number</strong></td>
  <td><strong>Client Name</strong></td>
  <td><strong>Client Type</strong></td>
  <td><strong>Gender</strong></td>
  <td><strong>City</strong></td>
  <td><strong>Zone</strong></td>
  <td><strong>Location</strong></td>
  <td><strong>Address</strong></td>
  <td><strong>Call Date</strong></td>
  <td><strong>CSO Name</strong></td>
  <td><strong>Call Start Time</strong></td>
  <td><strong>Call End Time</strong></td>
  <td><strong>Call Duration</strong></td>
  <td><strong>Call Status</strong></td>
  <td><strong>Call Type</strong></td>
  <td><strong>Notes</strong></td>
  <td><strong>Service Category</strong></td>
  <td><strong>Service Line</strong></td>
  <td><strong>Action</strong></td>
  <td><strong>Apointment Date</strong></td>
  <td><strong>Status</strong></td>
  <td><strong>Service Order Number</strong></td>
  <td><strong>Order Gateway</strong></td>
  <td><strong>Assigned Bp Name</strong></td>
  <td><strong>Assigned Bp Number</strong></td>
  <td><strong>Assigned Sp Name</strong></td>
  <td><strong>Assigned SP Number</strong></td>
  <td><strong>SP Quotation</strong></td>
  <td><strong>Negotiated Price</strong></td>
  <td><strong>Customer Agreed Price</strong></td>
  <td><strong>Demurrage</strong></td>
  <td><strong>Discount Amount</strong></td>
  <td><strong>SP Service Charge</strong></td>
  <td><strong>Psl Service Charge</strong></td>
  <td><strong>VAT</strong></td>
  <td><strong>Total Invoice Amount</strong></td>
  <td><strong>Customer Level</strong></td>
 </tr>
 <?
$i=0;
foreach($dat as $data){
	$i++;
?>
 <tr>
 <td><?=$i?></td>
 <td><?=$data['call_number_source']?></td>
<td><?=$data['contact_number']?></td>
<td><?=$data['client_name']?></td>
<td><?=$data['client_type']?></td>
<td><?=$data['gender']?></td>
<td><?=$data['city']?></td>
<td><?=$data['zone']?></td>
<td><?=$data['location']?></td>
<td><?=$data['address']?></td>
<td><?=$data['call_date']?></td>
<td><?=$data['cso_name']?></td>
<td><?=$data['call_start_time']?></td>
<td><?=$data['call_end_time']?></td>
<td><?=$data['call_duration']?></td>
<td><?=$data['call_status']?></td>
<td><?=$data['call_type']?></td>
<td><?=$data['notes']?></td>
<td><?=$data['service_category']?></td>
<td><?=$data['service_line']?></td>
<td><?=$data['action']?></td>
<td><?=$data['apointment_date']?></td>
<td><?=$data['status']?></td>
<td><?=$data['service_order_number']?></td>
<td><?=$data['order_gateway']?></td>
<td><?=$data['assigned_bp_name']?></td>
<td><?=$data['assigned_bp_number']?></td>
<td><?=$data['assigned_sp_name']?></td>
<td><?=$data['assigned_sp_number']?></td>
<td><?=$data['sp_quotation']?></td>
<td><?=$data['negotiated_price']?></td>
<td><?=$data['customer_agreed_price']?></td>
<td><?=$data['demurrage']?></td>
<td><?=$data['discount_amount']?></td>
<td><?=$data['sp_service_charge']?></td>
<td><?=$data['psl_service_charge']?></td>
<td><?=$data['vat']?></td>
<td><?=$data['total_invoice_amount']?></td>
<td><?=$data['customer_level']?></td>
 </tr>
 <? } ?>
</table>
</div>


 <?

$file_name ="CSO activities_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>


