<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\BpActivity;
use app\models\BpList;
use app\models\Zone;
use app\models\SsrTarget;
use app\models\AssignedActivities;

//$this->title = 'CSO Individual Call and SMQ Status';
$target_daterange = $target_from.' '.$target_to;
?>
<div class="site-index">
<strong>SSO's Activities</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>

<?   
 $connection = \Yii::$app->db;	
 $dat = $connection->createCommand("SELECT bp_activity.*,city.name as cname,zone.name as zname,service_category.category as sercat, service_lines.lines FROM bp_activity INNER JOIN city ON bp_activity.city = city.id INNER JOIN zone ON bp_activity.zone = zone.id INNER JOIN service_category ON bp_activity.service_category = service_category.id INNER JOIN service_lines ON bp_activity.service_line = service_lines.id where date between '".$target_from."' and '".$target_to."' order by id DESC")->queryAll();
 ?>
<table border="1" cellpadding="0" cellspacing="0">
 
 <tr>
 <td><strong>SL</strong></td>
  <td><strong>SSO ID</strong></td>
  <td><strong>SSO Name</strong></td>
  <td><strong>Date</strong></td>
  <td><strong>Week Day</strong></td>
  <td><strong>Company Name</strong></td>
  <td><strong>Clients Representative Name</strong></td>
  <td><strong>Clients Representative Number</strong></td>
  <td><strong>Customer Email</strong></td>
  <td><strong>Work Start Time</strong></td>
  <td><strong>Work End Time</strong></td>
  <td><strong>Work Duration</strong></td>
  <td><strong>City</strong></td>
  <td><strong>Zone</strong></td>
  <td><strong>Address</strong></td>
  <td><strong>Daily Status</strong></td>
  <td><strong>Assigned Activities</strong></td>
  <td><strong>Job Type</strong></td>
  <td><strong>Customers Categories</strong></td>
  <td><strong>Query Status</strong></td>
  <td><strong>Service Category</strong></td>
  <td><strong>Service Line</strong></td>
  <td><strong>Leaflet Distribution Number</strong></td>
  <td><strong>Apps Installed</strong></td>
  <td><strong>Notes</strong></td>
 </tr>
 <? 
 $i=0;
 foreach ($dat as $data){ 
 $i++;
 ?>
 <tr>
  <td><?=$i?></td>
  <td><?=$data['bp_id']?></td>
  <td><?=$data['bp_name']?></td>
<td><?=$data['date']?></td>
<td><?=$data['week_day']?></td>
<td><?=$data['company_name']?></td>
<td><?=$data['clients_representative_name']?></td>
<td><?=$data['clients_representative_number']?></td>
<td><?=$data['customer_email']?></td>
<td><?=$data['work_start_time']?></td>
<td><?=$data['work_end_time']?></td>
<td><?=$data['work_duration']?></td>
<td><?=$data['cname']?></td>
<td><?=$data['zname']?></td>
<td><?=$data['address']?></td>
<td><?=$data['daily_status']?></td>
<td><?=$data['assigned_activities']?></td>
<td><?=$data['job_type']?></td>
<td><?=$data['customers_categories']?></td>
<td><?=$data['query_status']?></td>
<td><?=$data['sercat']?></td>
<td><?=$data['lines']?></td>
<td><?=$data['leaflet_distribution_number']?></td>
<td><?=$data['apps_installed']?></td>
<td><?=$data['notes']?></td>

 </tr>
 <? } ?>
</table>
</div>


 <?

$file_name ="SSO’s Activities_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>


