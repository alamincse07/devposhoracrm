<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$connection = \Yii::$app->db;	
$dat = $connection->createCommand("SELECT *,service_category.category,service_lines.lines FROM `sales_activity` INNER JOIN service_category on sales_activity.services_category=service_category.id INNER JOIN service_lines on sales_activity.services_line=service_lines.id  where service_date between '". $target_from."' and '". $target_to."' order by service_date DESC")->queryAll();

//$this->title = 'CSO Individual Call and SMQ Status';
$target_daterange = $target_from.' '.$target_to;
?>
<div class="site-index">
<strong>Sales Report</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>
<table border="1" cellpadding="0" cellspacing="0">
  
  <tr>
    <td><strong>#</strong></td>
    <td><strong>Customer ID</strong></td>
    <td><strong>Invoice No</strong></td>
    <td><strong>Invoice Date</strong></td>
    <td><strong>Sales Catagories</strong></td>
    <td><strong>Sales Status</strong></td>
    <td><strong>Service Order Gateway</strong></td>
    <td><strong>Service Date</strong></td>
    <td><strong>Services Category</strong></td>
    <td><strong>Services Line</strong></td>
    <td><strong>Company Name B2b</strong></td>
    <td><strong>Customer Name</strong></td>
    <td><strong>Customer Mobile</strong></td>
    <td><strong>Customer Email</strong></td>
    <td><strong>Customer Address</strong></td>
    <td><strong>SP Name</strong></td>
    <td><strong>SP Cell Number</strong></td>
    <td><strong>City</strong></td>
    <td><strong>Zone</strong></td>
    <td><strong>Location</strong></td>
    <td><strong>Address</strong></td>
    <td><strong>Mode Of Payments</strong></td>
    <td><strong>Receiver Name</strong></td>
    <td><strong>Field Representative</strong></td>
    <td><strong>Name Of Representative</strong></td>
    <td><strong>Poshora Received Date</strong></td>
    <td><strong>Invoice Bill</strong></td>
    <td><strong>SSL Charge</strong></td>
    <td><strong>VAT</strong></td>
    <td><strong>Service Charge</strong></td>
    <td><strong>SSL Charge Factoring</strong></td>
    <td><strong>Poshora Charge</strong></td>
    <td><strong>SP Service Charges</strong></td>
    <td><strong>Poshora Received</strong></td>
    <td><strong>Additional Received</strong></td>
    <td><strong>SP Spare Parts</strong></td>
    <td><strong>SP Discount Demurrage</strong></td>
    <td><strong>Poshora Spare Parts</strong></td>
    <td><strong>Poshora Discount Demurrage</strong></td>
    <td><strong>Net Bill Claimed</strong></td>
    <td><strong>Deduction VAT</strong></td>
    <td><strong>Deduction AIT</strong></td>
    <td><strong>Net Paid</strong></td>
    <td><strong>Remarks</strong></td>
    <td><strong>Added Date</strong></td>
    <td><strong>Added By</strong></td>
    <td><strong>Edit Date</strong></td>
    <td><strong>Edit By</strong></td>

  </tr>
  <? foreach($dat as $data){ ?>
  <tr>
    <td align="center"><?=$data['id']?></td>
<td align="center"><?=$data['customer_id']?></td>
<td align="center"><?=$data['invoice_no']?></td>
<td align="center"><?=$data['invoice_date']?></td>
<td align="center"><?=$data['sales_catagories']?></td>
<td align="center"><?=$data['sales_status']?></td>
<td align="center"><?=$data['service_order_gateway']?></td>
<td align="center"><?=$data['service_date']?></td>
<td align="center"><?=$data['category']?></td>
<td align="center"><?=$data['lines']?></td>
<td align="center"><?=$data['company_name_b2b']?></td>
<td align="center"><?=$data['customer_name']?></td>
<td align="center"><?=$data['customer_mobile']?></td>
<td align="center"><?=$data['customer_email']?></td>
<td align="center"><?=$data['customer_address']?></td>
<td align="center"><?=$data['sp_name']?></td>
<td align="center"><?=$data['sp_cell_number']?></td>
<td align="center"><?=$data['city']?></td>
<td align="center"><?=$data['zone']?></td>
<td align="center"><?=$data['location']?></td>
<td align="center"><?=$data['address']?></td>
<td align="center"><?=$data['mode_of_payments']?></td>
<td align="center"><?=$data['receiver_name']?></td>
<td align="center"><?=$data['field_representative']?></td>
<td align="center"><?=$data['name_of_representative']?></td>
<td align="center"><?=$data['poshora_received_date']?></td>
<td align="center"><?=$data['invoice_bill']?></td>
<td align="center"><?=$data['ssl_charge']?></td>
<td align="center"><?=$data['vat']?></td>
<td align="center"><?=$data['service_charge']?></td>
<td align="center"><?=$data['ssl_charge_factoring']?></td>
<td align="center"><?=$data['poshora_charge']?></td>
<td align="center"><?=$data['sp_service_charges']?></td>
<td align="center"><?=$data['poshora_received']?></td>
<td align="center"><?=$data['additional_received']?></td>
<td align="center"><?=$data['sp_spare_parts']?></td>
<td align="center"><?=$data['sp_discount_demurrage']?></td>
<td align="center"><?=$data['poshora_spare_parts']?></td>
<td align="center"><?=$data['poshora_discount_demurrage']?></td>
<td align="center"><?=$data['net_bill_claimed']?></td>
<td align="center"><?=$data['deduction_vat']?></td>
<td align="center"><?=$data['deduction_ait']?></td>
<td align="center"><?=$data['net_paid']?></td>
<td align="center"><?=$data['remarks']?></td>
<td align="center"><?=$data['added_date']?></td>
<td align="center"><?=$data['added_by']?></td>
<td align="center"><?=$data['edit_date']?></td>
<td align="center"><?=$data['edit_by']?></td>

  </tr>
  <? } ?>
</table>
<p>&nbsp;</p>
</div>

<?

$file_name ="Sales Activities_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>