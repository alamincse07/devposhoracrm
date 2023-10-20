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
<strong>SSO’s Activities status</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>

<?   $cse = BpList::find()->all(); ?>
<table border="1" cellpadding="0" cellspacing="0">

 <tr>
  <td>&nbsp;</td>
  <td>SSO Name</td>
  <?	
  foreach ($cse as $cso){    
 
  ?>
  <td align="center" valign="middle"><?=$cso->bp_name;?></td>
   <? } ?>
  <td align="center" valign="middle">&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td>Working Days</td>
  <?	
  foreach ($cse as $cso){    
 
  ?>
  <td align="center" valign="middle" bgcolor="#BDD4E7">&nbsp;</td>
  <? } ?>
  <td align="center" valign="middle">&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td>Zone</td>
  <?	
  foreach ($cse as $cso){    
 	$zz = $cso->zone;
	 $zo = Zone::find()->where("id=".$cso->zone)->one();  
  ?>
  <td align="center" valign="middle"><?=$zo->name?></td>
  <? } ?>
  <td align="center" valign="middle">&nbsp;</td>
 </tr>
 <tr>
  <td>Activities</td>
  <td>&nbsp;</td>
  <?	
  foreach ($cse as $cso){    
  
  
 
  ?>
  <td align="center" valign="middle">Target|Achievement</td>
  <? } ?>
  <td align="center" valign="middle">Total</td>
 </tr>
 <tr>
  <td rowspan="2" bgcolor="#F2FF6C">1. Spot Sales</td>
  <td bgcolor="#F2FF6C">Target Sales (Qty)</td>
  <?	
   $tota=0;
   $tac=0;
  foreach ($cse as $cso){    
  
    $tar = SsrTarget::find()->where("ssr_id=".$cso->id." and target_daterange='".$target_daterange."'")->one();  
	 if($tar){$targ=$tar->spot_sales_target; $tota +=$targ;}else{ $targ='';}
	 
	  $ac = BpActivity::find()->where("bp_id='".$cso->id."' and (date between '".$target_from."' and '".$target_to."') and assigned_activities ='Spot Sales'")->count();
	  
 
  ?>
 <td align="center" valign="middle"><?=$targ?>|<? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tota?>|<?=$tac;?></td>
 </tr>
 <tr>
  <td bgcolor="#F2FF6C">Target Sales (Tk.)</td>
  <?	
  foreach ($cse as $cso){    
 
  ?>
  <td align="center" valign="middle" bgcolor="#F2FF6C">&nbsp;</td>
   <? } ?>
  <td align="center" valign="middle" bgcolor="#BDD4E7">&nbsp;</td>
 </tr>
 <?   
 $data = BpActivity::find()->select('assigned_activities')->where("date between '".$target_from."' and '".$target_to."'")->distinct()->all();
 
 $allaa= array();
 foreach($data as $bata)
 {
	$allaa[] = $bata->assigned_activities; 
 }
 
 
 $aa =AssignedActivities::find()->where("activity !='Spot Sales' and activity !='SP Acquision' and activity !='Client Visit For Service Assessment' and activity !='Client Visit During Service'")->orderBy(['activity' => SORT_ASC])->all();
 $i=1;
 	 foreach ($aa as $aaa){   
	 
	 $taa=0;
	 
	   if(in_array($aaa->activity,$allaa))
	   {
 	
  ?>
  
 <tr>
  <td><? if($i==1){?>2. BTL    Activities<? } ?></td>
  <td><?=$i?>. <?=$aaa->activity?></td>
  <?	
  foreach ($cse as $cso){    
  
 $ac = BpActivity::find()->where("bp_id='".$cso->id."' and (date between '".$target_from."' and '".$target_to."') and assigned_activities ='".$aaa->activity."'")->count();
 
  ?>
  <td align="center" valign="middle"><? echo $ac; $taa +=$ac;?></td>
 <? } ?>
  <td align="center" valign="middle"><?=$taa;?></td>
 </tr>
 <?  $i++;} } ?>
 
 <tr>
  <td align="left" valign="middle"><strong>Total BTL Activities</strong></td>
  <td align="center" valign="middle">&nbsp;</td>
  <?	
  $taa=0;
  foreach ($cse as $cso){    
  $ac = BpActivity::find()->where("bp_id='".$cso->id."' and (date between '".$target_from."' and '".$target_to."') and assigned_activities !='Spot Sales' and assigned_activities !='SP Acquision' and assigned_activities !='Client Visit For Service Assessment' and assigned_activities !='Client Visit During Service'")->count();
  ?>
   <td align="center" valign="middle"><? echo $ac; $taa +=$ac;?></td>
   <? } ?>
 <td align="center" valign="middle"><?=$taa;?></td>
 </tr>
 <tr>
  <td colspan="2">3. SP Sourcing in hand</td>
  <?	
    $tota=0;
   $tac=0;
  foreach ($cse as $cso){    
 
  $tar = SsrTarget::find()->where("ssr_id=".$cso->id." and target_daterange='".$target_daterange."'")->one();  
	 if($tar){$targ=$tar->spot_sales_target; $tota +=$targ;}else{ $targ='';}
	 
	  $ac = BpActivity::find()->where("bp_id='".$cso->id."' and (date between '".$target_from."' and '".$target_to."') and assigned_activities ='SP Acquision'")->count();
	  
 
  ?>
 <td align="center" valign="middle"><?=$targ?>|<? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tota?>|<?=$tac;?></td>
 </tr>
 <tr>
  <td colspan="2">4. Client Visit For Service Assess</td>
  <?	
    $tota=0;
   $tac=0;
  foreach ($cse as $cso){    
 
 $tar = SsrTarget::find()->where("ssr_id=".$cso->id." and target_daterange='".$target_daterange."'")->one();  
	 if($tar){$targ=$tar->spot_sales_target; $tota +=$targ;}else{ $targ='';}
	 
	  $ac = BpActivity::find()->where("bp_id='".$cso->id."' and (date between '".$target_from."' and '".$target_to."') and assigned_activities ='Client Visit For Service'")->count();
	  
 
  ?>
 <td align="center" valign="middle"><?=$targ?>|<? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tota?>|<?=$tac;?></td>
 </tr>
 <tr>
  <td colspan="2">5. Client Visit During Service</td>
  <?	
    $tota=0;
   $tac=0;
  foreach ($cse as $cso){    
 
 $tar = SsrTarget::find()->where("ssr_id=".$cso->id." and target_daterange='".$target_daterange."'")->one();  
	 if($tar){$targ=$tar->spot_sales_target; $tota +=$targ;}else{ $targ='';}
	 
	  $ac = BpActivity::find()->where("bp_id='".$cso->id."' and (date between '".$target_from."' and '".$target_to."') and assigned_activities ='Client Visit During Service'")->count();
	  
 
  ?>
 <td align="center" valign="middle"><?=$targ?>|<? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tota?>|<?=$tac;?></td>
 </tr>
</table>


</div>


 <?

$file_name ="SSO’s Activities status_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>


