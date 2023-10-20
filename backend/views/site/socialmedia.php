<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\CsoActivity;
use app\models\CsoList;
use app\models\CsoCallSourceTarget;
use app\models\CsoOtherTarget;
use app\models\SocialMediaCategory;
use app\models\SocialMediaQuery;
//$this->title = 'CSO Individual Call and SMQ Status';
$target_daterange = $target_from.' '.$target_to;
?>
<div class="site-index">
<strong>CSO Social Media Query</strong>
<p>Date: <?=date('d-m-Y',strtotime($target_from))?> to <?=date('d-m-Y',strtotime($target_to))?></p>

<table width="50%" border="1" cellpadding="0" cellspacing="0">

 <tr>
  <td width="80%" bgcolor="#7EE186"><strong>Category</strong></td>
  <td width="30%" align="center" valign="middle" bgcolor="#7EE186"><strong>Count</strong></td>
 </tr>
 <?
 $ss = SocialMediaCategory::find()->orderBy(['category' => SORT_ASC])->all();
 foreach ($ss as $sss){
 $sc = SocialMediaQuery::find()->where("category='".$sss->category."' and (response_datetime between '".$target_from."' and '".$target_to."')")->all();
 ?>
 <tr>
  <td><?=$sss->category?></td>
  <td align="center" valign="middle"><?= count($sc);?></td>
 </tr>
 <? } ?>
</table>

</div>

<?

$file_name ="CSO Social Media Query_".$target_daterange.".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
echo $excel_file;

?>