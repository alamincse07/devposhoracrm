<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\CsoActivity;
use app\models\CsoList;
use app\models\CsoCallSourceTarget;
use app\models\CsoOtherTarget;
use app\models\CallNumberSource;
use app\models\SocialMediaQuery;
//$this->title = 'CSO Individual Call and SMQ Status';
$target_daterange = $target_from.' '.$target_to;
?>
<div class="site-index">
<strong>CSO Individual Sales Status</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>


<table width="100%" border="1" cellpadding="0" cellspacing="0">
<?
$ss = CsoCallSourceTarget::find()->select(['call_source'])->distinct()->orderBy(['call_source' => SORT_ASC])->all();
?>
 <tr>
  <td width="20%" align="center" valign="middle" bgcolor="#A4D797"><strong>CSO</strong></td>
  <? foreach($ss as $sss){ ?>
  <td align="center" valign="middle" bgcolor="#A4D797"><strong>
   <?=$sss->call_source?>
   <br>Target|Achieved</strong></td>
  <? } ?>
 <td align="center" valign="middle" bgcolor="#A4D797"><strong>Total</strong></td>
 </tr>
  <?
$cse = CsoList::find()->all();

$cal=0;
$sol=0;
foreach ($cse as $cso){
	$cid= $cso->id;
	$tt = CsoCallSourceTarget::find()->where("cso_id=".$cid." and target_daterange='".$target_daterange."'")->all();
	
	$csotar = array();
	$csoarc = array();
	foreach($tt as $ttt)
	{
		$git= $ttt->call_source;
		$csotar[$git] = $ttt->target;
		$ac = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."') and call_number_source ='".$ttt->call_source."'")->count();
		
		$csoarc[$git] = $ac;
	}
	?>
 <tr>
 <td><?=$cso->cso_name;?></td>
   <? foreach($ss as $sss){ ?>
  <td align="center" valign="middle"><?=$csotar[$sss->call_source];?>|<?=$csoarc[$sss->call_source];?></td>
 <? } ?>
 <td align="center" valign="middle"><strong>
  <?=array_sum($csotar);?>
  |<?=array_sum($csoarc);?>
 </strong></td>
 </tr>
 <? } ?>
 <tr>
  <td><strong>Total</strong></td>
   <? foreach($ss as $sss){ 
   $tt = CsoCallSourceTarget::find()->where("call_source='".$sss->call_source."' and target_daterange='".$target_daterange."'");
   $ac = CsoActivity::find()->where("(call_date between '".$target_from."' and '".$target_to."') and call_number_source ='".$ttt->call_source."'")->count();
   
   ?>
  <td align="center" valign="middle"><strong><? echo $tt->sum('target'); $cal += $tt->sum('target');?>|<? echo $ac; $sol +=$ac;?></strong></td>
 <? } ?>
  <td align="center" valign="middle"><strong>
   <?=$cal?>
   |<?=$sol?>
  </strong></td>
  
 </tr>
</table>
</div>

<?

$file_name ="CSO Individual Sales Status_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>