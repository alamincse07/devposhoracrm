<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\SocialMediaQuery;


//$this->title = 'CSO Individual Call and SMQ Status';
$target_daterange = $target_from.' '.$target_to;

$connection = \Yii::$app->db;	



  $dat = $connection->createCommand("SELECT social_media_query.*,service_category.category as sercat, service_lines.lines FROM social_media_query INNER JOIN service_category ON social_media_query.service_category = service_category.id INNER JOIN service_lines ON social_media_query.service_line = service_lines.id where response_date between '".$target_from."' and '".$target_to."' order by response_datetime DESC")->queryAll();
?>
<div class="site-index">
<strong>Social Media Queries</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>

<table border="1" cellpadding="0" cellspacing="0">
 
 <tr>
     <td align="center"><strong>#</strong></td>
     <td align="center"><strong>Query Datetime</strong></td>
     <td align="center"><strong>Query Date</strong></td>
     <td align="center"><strong>Query Time</strong></td>
     <td align="center"><strong>Name</strong></td>
     <td align="center"><strong>Mobile</strong></td>
     <td align="center"><strong>Query Type</strong></td>
     <td  align="center"><strong>Response Datetime</strong></td>
     <td align="center"><strong>Response Date</strong></td>
     <td align="center"><strong>Response Time</strong></td>
     <td align="center"><strong>Query Details</strong></td>
     <td align="center"><strong>Service Category</strong></td>
     <td align="center"><strong>Service Line</strong></td>
     <td align="center"><strong>Category</strong></td>
     <td align="center"><strong>Hide Del Ban</strong></td>
     <td align="center"><strong>Cso Name</strong></td>
     <td align="center"><strong>Response Time Duration</strong></td>
     <td align="center"><strong>Remarks</strong></td>
     <td align="center"><strong>Media</strong></td>
   </tr>
 <?
$i=0;
foreach($dat as $data){
	$i++;
?>
 <tr>
 <td><?=$data['id']?></td>
 <td valign="middle"><?=$data['query_datetime']?></td>
<td valign="middle"><?=$data['query_date']?></td>
<td valign="middle"><?=$data['query_time']?></td>
<td valign="middle"><?=$data['name']?></td>
<td valign="middle"><?=$data['mobile']?></td>
<td valign="middle"><?=$data['query_type']?></td>
<td valign="middle"><?=$data['response_datetime']?></td>
<td valign="middle"><?=$data['response_date']?></td>
<td valign="middle"><?=$data['response_time']?></td>
<td valign="middle"><?=$data['query_details']?></td>
<td valign="middle"><?=$data['sercat']?></td>
<td valign="middle"><?=$data['lines']?></td>
<td valign="middle"><?=$data['category']?></td>
<td valign="middle"><?=$data['hide_del_ban']?></td>
<td valign="middle"><?=$data['cso_name']?></td>
<td valign="middle"><?=$data['response_time_duration']?></td>
<td valign="middle"><?=$data['remarks']?></td>
<td valign="middle"><?=$data['media']?></td>
 </tr>
 <? } ?>
</table>
</div>


 <?

$file_name ="Social Media Queries_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>
