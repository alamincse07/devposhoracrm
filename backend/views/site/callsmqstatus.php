<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\CsoActivity;
use app\models\CsoList;
use app\models\CsoOtherTarget;
use app\models\SocialMediaQuery;
//$this->title = 'CSO Individual Call and SMQ Status';
$target_daterange = $target_from.' '.$target_to;
?>
<div class="site-index">
<strong>CSO Individual Call and SMQ Status</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0">

 <tr>
  <td width="25%"><strong>CSO</strong></td>
  <td width="25%" align="center" valign="middle"><strong>Call Target</strong></td>
  <td width="25%" align="center" valign="middle"><strong>Call Achievement</strong></td>
  <td width="25%" align="center" valign="middle"><strong>SMQ Reply</strong></td>
 </tr>
 <?
$cse = CsoList::find()->all();
$tota=0;
$cal=0;
$sol=0;
foreach ($cse as $cso){
	$cid= $cso->id;
	
	$tar = CsoOtherTarget::find()->where("cso_id=".$cid." and target_daterange='".$target_daterange."'")->one();
	if($tar){$targ=$tar->call_target; $tota +=$targ;}else{ $targ='';}
	
	$ac = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."')")->all();
	if($ac){$ach = count($ac); $cal +=$ach;}else{$ach=0;}
	$sc = SocialMediaQuery::find()->where("cso_name='".$cso->cso_name."' and (response_datetime between '".$target_from."' and '".$target_to."')")->all();
	if($sc){$sch = count($sc); $sol +=$sch;}else{$sch=0;}
	
?>

 <tr>
  <td><?=$cso->cso_name;?></td>
  <td align="center" valign="middle"><?=$targ?></td>
  <td align="center" valign="middle"><?=$ach;?></td>
  <td align="center" valign="middle"><?=$sch;?></td>
 </tr>
 <? } ?>
 <tr>
  <td><strong>Total    Achievement</strong></td>
  <td align="center" valign="middle"><strong>
   <?=$tota?>
  </strong></td>
  <td align="center" valign="middle"><strong>
   <?=$cal?>
  </strong></td>
  <td align="center" valign="middle"><strong>
   <?=$sol?>
  </strong></td>
 </tr>
</table>

</div>

<?

$file_name ="CSO Individual Call and SMQ_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>