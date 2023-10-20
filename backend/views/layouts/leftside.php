<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;

$ac[]='action';
$ac[]='assainedperson';
//$ac[]='user';
$ac[]='assignedactivities';
$ac[]='bplist';
$ac[]='csolist';
$ac[]='callnumbersource';
$ac[]='calltype';
$ac[]='clienttype';
$ac[]='customerlevel';
$ac[]='customerscategories';
$ac[]='dailystatus';
$ac[]='jobtype';
$ac[]='ordergateway';
$ac[]='querystatus';
$ac[]='status';
$ac[]='city';
$ac[]='zone';
$ac[]='location';
$ac[]='servicecategory';
$ac[]='servicelines';
$ac[]='socialmediacategory';
$ac[]='salescategory';
$ac[]='modeofpayment';

$rr[]='csoreports';
$rr[]='ssrreports';
$cc[]='invoice';
$cc[]='salesactivity';
$cc[]='customer';


 $uu= $_SERVER['REQUEST_URI']; 
				$uuv = explode('/',$uu);
				if(count($uuv)==4)
				{
				$pg = $uuv[3];
				}
				elseif(count($uuv)==5)
				{
				$pg = $uuv[4];
				}
		
 ?>
<!-- Left side column. contains the logo and sidebar -->
 
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    
    
    <ul class="sidebar-menu">
    <li class="active"><a href="/poshoracrm/admin/"><i class="fa fa-dashboard"></i>  <span>Dashboard</span></a></li>
    <?
$sesdb =  Yii::$app->apu->sesdata('user_level');
if($sesdb =='supadmin')
{
?>

 <li <? if (in_array($pg, $ac)){ ?> class="active" <? } ?>><a href="#"><i class="fa fa-gears"></i>  <span>System Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class='treeview-menu' >
<li <? if($pg=='action'){?> class="active"<? }?>><a href="/poshoracrm/admin/action"><i class="fa fa-database"></i>  <span>Action</span></a></li>
<li <? if($pg=='assainedperson'){?> class="active"<? }?>><a href="/poshoracrm/admin/assainedperson"><i class="fa fa-database"></i>  <span>Assained Person</span></a></li>
 <li <? if($pg=='assignedactivities'){?> class="active"<? }?>><a href="/poshoracrm/admin/assignedactivities"><i class="fa fa-database"></i>  <span>Assigned Activities</span></a></li>

 <li <? if($pg=='bplist'){?> class="active"<? }?>><a href="/poshoracrm/admin/bplist"><i class="fa fa-database"></i>  <span>SSO List</span></a></li>
<li <? if($pg=='csolist'){?> class="active"<? }?>><a href="/poshoracrm/admin/csolist"><i class="fa fa-database"></i>  <span>CSO List</span></a></li>
<li <? if($pg=='callnumbersource'){?> class="active"<? }?>><a href="/poshoracrm/admin/callnumbersource"><i class="fa fa-database"></i>  <span>Call Number Source</span></a></li>
<li <? if($pg=='calltype'){?> class="active"<? }?>><a href="/poshoracrm/admin/calltype"><i class="fa fa-database"></i>  <span>Call Type</span></a></li>

<li <? if($pg=='clienttype'){?> class="active"<? }?>><a href="/poshoracrm/admin/clienttype"><i class="fa fa-database"></i>  <span>Client Type</span></a></li>

<li <? if($pg=='customerlevel'){?> class="active"<? }?>><a href="/poshoracrm/admin/customerlevel"><i class="fa fa-database"></i>  <span>Customer Level</span></a></li>
<li <? if($pg=='customerscategories'){?> class="active"<? }?>><a href="/poshoracrm/admin/customerscategories"><i class="fa fa-database"></i>  <span>Customers Categories</span></a></li>
<li <? if($pg=='dailystatus'){?> class="active"<? }?>><a href="/poshoracrm/admin/dailystatus"><i class="fa fa-database"></i>  <span>Daily Status</span></a></li>
<li <? if($pg=='jobtype'){?> class="active"<? }?>><a href="/poshoracrm/admin/jobtype"><i class="fa fa-database"></i>  <span>Job Type</span></a></li>
<li <? if($pg=='ordergateway'){?> class="active"<? }?>><a href="/poshoracrm/admin/ordergateway"><i class="fa fa-database"></i>  <span>Order Gateway</span></a></li>
<li <? if($pg=='querystatus'){?> class="active"<? }?>><a href="/poshoracrm/admin/querystatus"><i class="fa fa-database"></i>  <span>Query Status</span></a></li>
<li <? if($pg=='status'){?> class="active"<? }?>><a href="/poshoracrm/admin/status"><i class="fa fa-database"></i>  <span>Status</span></a></li>
<li <? if($pg=='city'){?> class="active"<? }?>><a href="/poshoracrm/admin/city"><i class="fa fa-database"></i>  <span>City</span></a></li>
<li <? if($pg=='zone'){?> class="active"<? }?>><a href="/poshoracrm/admin/zone"><i class="fa fa-database"></i>  <span>Zone</span></a></li>
<li <? if($pg=='location'){?> class="active"<? }?>><a href="/poshoracrm/admin/location"><i class="fa fa-database"></i>  <span>Location</span></a></li>
<li <? if($pg=='servicecategory'){?> class="active"<? }?>><a href="/poshoracrm/admin/servicecategory"><i class="fa fa-database"></i>  <span>Service Category</span></a></li>
<li <? if($pg=='servicelines'){?> class="active"<? }?>><a href="/poshoracrm/admin/servicelines"><i class="fa fa-database"></i>  <span>Servicelines</span></a></li>
<li <? if($pg=='socialmediacategory'){?> class="active"<? }?>><a href="/poshoracrm/admin/socialmediacategory"><i class="fa fa-database"></i>  <span>Social  Media Category</span></a></li>
<li <? if($pg=='modeofpayment'){?> class="active"<? }?>><a href="/poshoracrm/admin/modeofpayment"><i class="fa fa-database"></i>  <span>Payment Mode</span></a></li>
<li <? if($pg=='salescategory'){?> class="active"<? }?>><a href="/poshoracrm/admin/salescategory"><i class="fa fa-database"></i>  <span>Sales Category</span></a></li>
</ul>
</li>
<li <? if($pg=='ssrtarget'){?> class="active"<? }?>><a href="/poshoracrm/admin/ssrtarget"><i class="fa fa-pencil"></i>  <span>SSO Target</span></a></li>
<li <? if($pg=='bpactivity'){?> class="active"<? }?>><a href="/poshoracrm/admin/bpactivity"><i class="fa fa-pencil"></i>  <span>SSO Activity</span></a></li>
<li <? if($pg=='csocallsourcetarget'){?> class="active"<? }?>><a href="/poshoracrm/admin/csocallsourcetarget"><i class="fa fa-pencil"></i>  <span>CSO Call Source Target</span></a></li>
<li <? if($pg=='csoothertarget'){?> class="active"<? }?>><a href="/poshoracrm/admin/csoothertarget"><i class="fa fa-pencil"></i>  <span>CSO Call Target</span></a></li>

<li <? if($pg=='csoactivity'){?> class="active"<? }?>><a href="/poshoracrm/admin/csoactivity"><i class="fa fa-table"></i>  <span>CSO Activity</span></a></li>
<li <? if($pg=='socialmediaquery'){?> class="active"<? }?>><a href="/poshoracrm/admin/socialmediaquery"><i class="fa fa-facebook"></i>  <span>Social Media Query</span></a></li>


 <li <? if (in_array($pg, $rr)){ ?> class="active" <? } ?>><a href="#"><i class="fa fa-th"></i>  <span>Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class='treeview-menu' >
<li <? if($pg=='csoreports'){?> class="active"<? }?>><a href="/poshoracrm/admin/site/csoreports"><i class="fa fa-edit"></i>  <span>CSO Reports</span></a></li>

<li <? if($pg=='ssrreports'){?> class="active"<? }?>><a href="/poshoracrm/admin/site/ssrreports"><i class="fa fa-edit"></i>  <span>SSO's Activities Report</span></a></li>
 </ul>    
 </li>

 
 <li <? if($pg=='user'){?> class="active"<? }?>><a href="/poshoracrm/admin/user"><i class="fa fa-users"></i>  <span>Users</span></a></li>
<?php /*?><li><a href="/poshoracrm/admin/useraccess"><i class="fa fa-users"></i>  <span>User Access</span></a></li><?php */?>
    
<? }if($sesdb =='bp'){ ?>


<li><a href="/poshoracrm/admin/bpactivity"><i class="fa fa-pencil"></i>  <span>SSO Activity</span></a></li>

<? } ?>   
<? if($sesdb =='cso'){ ?>


<li><a href="/poshoracrm/admin/csoactivity"><i class="fa fa-table"></i>  <span>CSO Activity</span></a></li>
<li><a href="/poshoracrm/admin/socialmediaquery"><i class="fa fa-facebook"></i>  <span>Social Media Query</span></a></li>

<? } ?>   
  <li <? if (in_array($pg, $cc)){ ?> class="active" <? } ?>><a href="#"><i class="fa fa-th"></i>  <span>Customer & Sales</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class='treeview-menu' >
<li <? if($pg=='customer'){?> class="active"<? }?>><a href="/poshoracrm/admin/customer"><i class="fa fa-user"></i>  <span>Customers </span></a></li>   
<li <? if($pg=='invoice'){?> class="active"<? }?>><a href="/poshoracrm/admin/customer/invoice"><i class="fa fa-user"></i>  <span>Create Sales</span></a></li>   
<li <? if($pg=='salesactivity'){?> class="active"<? }?>><a href="/poshoracrm/admin/salesactivity"><i class="fa fa-pencil"></i>  <span>Sales Lists</span></a></li>
<li <? if($pg=='salesreports'){?> class="active"<? }?>><a href="/poshoracrm/admin/site/salesreports"><i class="fa fa-edit"></i>  <span>Sales Report</span></a></li>

 </ul>    
 </li>

  </ul>    

    </section>
    <!-- /.sidebar -->
</aside>
