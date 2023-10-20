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
<strong>CSO Service Status</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>

<?   $cse = CsoList::find()->all(); ?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">

 <tr>
  <td width="250">&nbsp;</td>
  <?	
  foreach ($cse as $cso){    
 
  ?>
  <td align="center" valign="middle" bgcolor="#A0E798"><?=$cso->cso_name;?></td>
  <? } ?>
  <td align="center" valign="middle" bgcolor="#A0E798">Total</td>
 </tr>
 <tr>
  <td bgcolor="#B2D7E9">Particular</td>
   <?	foreach ($cse as $cso){    ?>
  <td align="center" valign="middle" bgcolor="#B2D7E9">Target|Achieved</td>
   <? } ?>
  <td align="center" valign="middle" bgcolor="#B2D7E9">Target|Achieved</td>
 
 </tr>
 <tr>
  <td>Sales   Conversion</td>
   <?	
   
   $tota=0;
   $tac=0;
   foreach ($cse as $cso){   
    $tar = CsoOtherTarget::find()->where("cso_id=".$cso->id." and target_daterange='".$target_daterange."'")->one();  
  if($tar){$targ=$tar->sales_conversion_target; $tota +=$targ;}else{ $targ='';}
    $ac = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."') and status ='	
Completed'")->count();
    ?>
  <td align="center" valign="middle"><?=$targ?>|<? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tota?>|<?=$tac;?></td>
 </tr>
 <tr>
  <td>Sales Amount</td>
   <?	
    $ttota=0;
	 $tota=0;
   foreach ($cse as $cso){  
  
    $tt = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."')");
	 $tars = CsoOtherTarget::find()->where("cso_id=".$cso->id." and target_daterange='".$target_daterange."'")->one();  
  if($tars){$targs=$tars->sales_amount_target; $tota +=$targs;}else{ $targs='';}
  
  $ac = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."') and status ='Confirmed'")->count();
   
    ?>
  <td align="center" valign="middle"><?=$targs?>|<? echo $ac; $tac +=$ac;?><? echo $tt->sum('total_invoice_amount');  $ttota += $tt->sum('total_invoice_amount');?></td>
  <? } ?>
  <td align="center" valign="middle"><?=$tota?>|<?=$ttota?></td>
 </tr>
 <tr>
  <td>Poshora    Received</td>
   <?	foreach ($cse as $cso){    ?>
  <td>&nbsp;</td>
   <? } ?>
  <td>&nbsp;</td>
 
 </tr>
 <tr>
  <td>Order    Confirmed</td>
   <?	
   $tac=0;
   foreach ($cse as $cso){   
   
    $ac = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."') and status ='Confirmed'")->count();
   
    ?>
 <td align="center" valign="middle"><? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tac;?></td>
 
 </tr>
 <tr>
  <td>Requested</td>
    <?	
   $tac=0;
   foreach ($cse as $cso){   
   
    $ac = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."') and status ='Requested'")->count();
   
    ?>
 <td align="center" valign="middle"><? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tac;?></td>
  
 </tr>
 <tr>
  <td>Decline</td>
   <?	
   $tac=0;
   foreach ($cse as $cso){   
   
    $ac = CsoActivity::find()->where("cso_name='".$cso->cso_name."' and (call_date between '".$target_from."' and '".$target_to."') and status ='Declined'")->count();
   
    ?>
 <td align="center" valign="middle"><? echo $ac; $tac +=$ac;?></td>
   <? } ?>
  <td align="center" valign="middle"><?=$tac;?></td>
 
 </tr>
</table>

</div>


 <?

$file_name ="CSO Service Status_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>


