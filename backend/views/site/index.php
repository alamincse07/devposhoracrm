<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use app\models\CsoActivity;
use app\models\CsoList;
use app\models\CsoCallSourceTarget;
use app\models\CsoOtherTarget;
use app\models\CallNumberSource;
use app\models\SocialMediaQuery;
use app\models\SocialMediaCategory;


$this->title = 'Admin Dashboard';

//$from = '2023-01-01';
//$to = '2023-03-14';

$newfrom = date("d", strtotime($from));
$newto =  date("d M, Y", strtotime($to));
$asof = $newfrom.' to '.$newto;
 
$query = CsoOtherTarget::find()->select('target_daterange')->distinct()->limit(6)->orderBy(['target_daterange' => SORT_DESC])->all();
$csotarcat='';
foreach($query as $q)
{
	$dd = explode(' ',$q->target_daterange);
	$dds = explode('-',$dd[0]);
	$dde = explode('-',$dd[1]);
	
	$month_num =  date("M", mktime(0, 0, 0, $dds[1], 10));	
	$ff = $dds[2].' to '. $dde[2].' '. $month_num.' '. $dds[0];	
	$csotarcat .="'".$ff."',"; 
}


?>
<style>
@import "https://code.highcharts.com/css/highcharts.css";


/*
.highcharts-color-0 {
    fill: #7cb5ec;
    stroke: #7cb5ec;
}

.highcharts-axis.highcharts-color-0 .highcharts-axis-line {
    stroke: #7cb5ec;
}

.highcharts-axis.highcharts-color-0 text {
    fill: #7cb5ec;
}

.highcharts-color-1 {
    fill: #90ed7d;
    stroke: #90ed7d;
}

.highcharts-axis.highcharts-color-1 .highcharts-axis-line {
    stroke: #90ed7d;
}

.highcharts-axis.highcharts-color-1 text {
    fill: #90ed7d;
}*/

</style>


<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="site-index">
<?php $form = ActiveForm::begin(['action' => ['index'],'options' => ['method' => 'post']]) ?>
<div class="row">
        <div class="col-md-4">
 <strong>From:</strong>&nbsp;&nbsp;
			<?= yii\jui\DatePicker::widget(['name' => 'start_date', 'clientOptions' => ['defaultDate' => 'php:Y-m-d'], 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d',]) ?>
            </div>
			  <div class="col-md-4">
      <strong>To:</strong>&nbsp;&nbsp;<?= yii\jui\DatePicker::widget(['name' => 'end_date', 'clientOptions' => ['defaultDate' => 'php:Y-m-d'], 'options' => ['class' => 'form-control'], 'dateFormat' => 'php:Y-m-d',]) ?>  
      </div>
       <div class="col-md-4">
       <br>
       <input type="submit" class="btn btn-info" value="Search" name="filter"> 
       
       </div>
      </div>
  <?php ActiveForm::end(); ?><br>
 <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
         
            <div class="box-body text-center">
             
           <div id="target"></div>
         
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col (left) -->
          <div class="col-md-6">
          <div class="box box-solid">
           
            <div class="box-body text-center">
          	
           <div id="callstatus"></div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      
      </div>
      <!-- /.row -->


      <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
         
            <div class="box-body text-center">
             
        <div id="socialmedia"></div>
         
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-solid">
       
            <div class="box-body text-center">
          	
          <div id="socialmediacat"></div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
   <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
         
            <div class="box-body text-center">
             
           <div id="smqr9"></div>
         
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col (left) -->
          <div class="col-md-6">
          <div class="box box-solid">
           
            <div class="box-body text-center">
          	
             <div id="smqr8"></div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <!-- /.col (right) -->
      
      </div>
 <!-- /.row -->
 
 
 
 

</div>


<?
//target graph

$query = CsoOtherTarget::find()->select('target_daterange')->distinct()->limit(6)->orderBy(['target_from' => SORT_DESC])->all();
$csotarcat='';
$csotar='';
$csokorse = '';
$ttar=0;
$tarc=0;
foreach($query as $q)
{
	$dd = explode(' ',$q->target_daterange);
	$dds = explode('-',$dd[0]);
	$dde = explode('-',$dd[1]);
	
	$target_from = $dd[0];
	$target_to = $dd[1];
	
	$month_num =  date("M", mktime(0, 0, 0, $dds[1], 10));	
	$ff = $dds[2].' to '. $dde[2].' '. $month_num.' '. $dds[0];	
	$csotarcat .="'".$ff."',"; 
	
	
	 $tar = CsoOtherTarget::find()->where("target_daterange='".$q->target_daterange."'");  
	$csotar .= $tar->sum('call_target').', ';
	$ttar += (int)$tar->sum('call_target');
	
//	echo "(call_date between '".$target_from."' and '".$target_to."') ";
	$ac = CsoActivity::find()->where("(call_date between '".$target_from."' and '".$target_to."') ")->count();
	
	$csokorse .= $ac.', ';
	$tarc +=$ac;
	
}

?>
<script>

Highcharts.chart('target', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'CSO Call Target / Achievement',
	 align: 'left'
  },
 /* subtitle: {
    text: 'Source: WorldClimate.com'
  },*/
  xAxis: {
    categories: [<?=$csotarcat ?> ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Total Target: <?=$ttar;?><br>Total Achievement: <?=$tarc?>'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:15px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y} </b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    name: 'Target',
    data: [<?=$csotar?>]

  },{
    name: 'Achievement',
    data: [<?=$csokorse?>]

  },]
});
</script>      
<?

$Interested = CsoActivity::find()->where("(call_date between '".$from."' and '".$to."') and call_status='Interested' ")->count();
$noans = CsoActivity::find()->where("(call_date between '".$from."' and '".$to."') and call_status='No Answer' ")->count();
$busy = CsoActivity::find()->where("(call_date between '".$from."' and '".$to."') and call_status='Busy' ")->count();
$noti = CsoActivity::find()->where("(call_date between '".$from."' and '".$to."') and call_status='Not Interested' ")->count();
$soff = CsoActivity::find()->where("(call_date between '".$from."' and '".$to."') and call_status='Switched Off' ")->count();
$wn = CsoActivity::find()->where("(call_date between '".$from."' and '".$to."') and call_status='Wrong Number' ")->count();

$total = $Interested+$noans+$busy+$noti+$soff+$wn;
$callstatusdata = "{
            name: 'Interested',
            y: ".$Interested.",
            sliced: true,
            selected: true
        },  {
            name: 'No Answer',
            y: ".$noans."
        },  {
            name: 'Busy',
            y: ".$busy."
        }, {
            name: 'Not Interested',
            y: ".$noti."
        }, {
            name: 'Switched Off',
            y: ".$soff."
        }, {
            name: 'Wrong Number',
            y: ".$wn."
        }";
?>

<script>
Highcharts.chart('callstatus', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Call Status',
        align: 'left'
    },
	 subtitle: {
    text: '<?=$asof?><br><b>Total Call: <?=$total?></b>'
  },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
        data: [<?=$callstatusdata?>]
    }]
});


</script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>

<?
$squery = SocialMediaQuery::find()->select('media')->distinct()->all();
$socialdata ='';
$stotal = 0;

$ding = SocialMediaQuery::find()->where("(response_date between '".$from."' and '".$to."') ")->count();

foreach($squery as $sm)
{
	$ching = SocialMediaQuery::find()->where("(response_date between '".$from."' and '".$to."') and media='".$sm->media."' ")->count();
	$socialdata .= "{ name: '".$sm->media."',y: ".$ding.",z: ".$ching." },";
	$stotal += $ching ;
	
}


?>

<script>
Highcharts.chart('socialmedia', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: 'Social Media Query',
        align: 'left'
    },
	 subtitle: {
    text: '<?=$asof?><br><b>Total Query: <?=$stotal?></b>'
  },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b>' + ' <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        data: [<?=$socialdata?>]
    }]
});


</script>

<?
$cing = SocialMediaCategory::find()->all();
	$scate='';

$sdata = '';
foreach($cing as $ca)
{

	
	$scate .="'".$ca->category."',"; 

	$sac  = SocialMediaQuery::find()->where("(response_datetime between '".$from."' and '".$to."') and category='".$ca->category."' ")->count();
	
	$sdata .= " { name: '".$ca->category."',  y: ".$sac.", },";
	

}


?>
<script>

Highcharts.chart('socialmediacat', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Social Media Query Type'
    },
	 subtitle: {
    text: '<?=$asof?>'
  },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Query: <?=$stotal?>'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:15px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },

    series: [
        {
            name: 'Query Type',
            colorByPoint: true,
            data: [
               <?=$sdata?>
            ]
        }
    ],
   
});

</script>      


<?
//smqr9 graph


 $rmon =  date('M, Y');
 
  $rmonqu =   date('Y-m');
 $rmonqufirst = $rmonqu.'-01';
  $rmonqufirstlast = $rmonqu.'-15';
   $rmonqulastfirst = $rmonqu.'-16';
$rmonqulast =   date("Y-m-t", strtotime($rmon));
 
 
 $name3 =  '1 to 15 '.$rmon;
 $name4 =  '16 to '. date("t", strtotime( date('M, Y'))).' '.$rmon;
 
 
 $pmon =   date('M, Y', strtotime(date('Y-m')." -1 month"));
 $pmonqu =   date('Y-m', strtotime(date('Y-m')." -1 month"));
 $pmonqufirst = $pmonqu.'-01';
  $pmonqufirstlast = $pmonqu.'-15';
   $pmonqulastfirst = $pmonqu.'-16';
$pmonqulast =   date("Y-m-t", strtotime($pmon));
 $name1 =  '1 to 15 '.$pmon;
$name2 =  '16 to '. date("t", strtotime($pmon)).' '.$pmon;

$name1q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqufirst."' and '".$pmonqufirstlast."') and (response_time BETWEEN '09:01' and '20:00') ")->count();

$name1rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqufirst."' and '".$pmonqufirstlast."') and (response_time BETWEEN '09:01' and '20:00') ");
 $name1rt = $name1rtq->sum('response_time_duration');
  if($name1q)
 {
	$name1rtav =  round($name1rt /$name1q);
 }
 else
 {
	 $name1rtav = 0;
 }




$name2q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqulastfirst."' and '".$pmonqulast."') and (response_time BETWEEN '09:01' and '20:00') ")->count();

$name2rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqulastfirst."' and '".$pmonqulast."') and (response_time BETWEEN '09:01' and '20:00') ");
 $name2rt = $name2rtq->sum('response_time_duration');
  if($name2q)
 {
	$name2rtav =  round($name2rt /$name2q);
 }
 else
 {
	 $name2rtav = 0;
 }




$name3q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqufirst."' and '".$rmonqufirstlast."') and (response_time BETWEEN '09:01' and '20:00') ")->count();

$name3rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqufirst."' and '".$rmonqufirstlast."') and (response_time BETWEEN '09:01' and '20:00') ");
 $name3rt = $name3rtq->sum('response_time_duration');
  if($name3q)
 {
	$name3rtav =  round($name3rt /$name3q);
 }
 else
 {
	 $name3rtav = 0;
 }



$name4q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqulastfirst."' and '".$rmonqulast."') and (response_time BETWEEN '09:01' and '20:00') ")->count();

$name4rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqulastfirst."' and '".$rmonqulast."') and (response_time BETWEEN '09:01' and '20:00') ");
 $name4rt = $name4rtq->sum('response_time_duration');
 
 if($name4q)
 {
$name4rtav =  round($name4rt /$name4q);
 }
 else
 {
	 $name4rtav = 0;
 }



?>
<script>


Highcharts.chart('smqr9', {
   chart: {
            type: 'column'
        },
        title: {
            text: 'SM Query Response Time (9 AM - 8 PM)'
        },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: true
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },

        series: [{
            name: '<?=$name1?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name1q ?>,
               
            }, {
                name: 'response',
                y: <?=$name1rtav ?>,
               
            }]
        }, {
           name: '<?=$name2?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name2q ?>,
               
            }, {
                name: 'response',
                y: <?=$name2rtav ?>,
               
            }]
        },
		{
            name: '<?=$name3?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name3q ?>,
               
            }, {
                name: 'response',
                y: <?=$name3rtav ?>,
               
            }]
        }, {
           name: '<?=$name4?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name4q ?>,
               
            }, {
                name: 'response',
                y: <?=$name4rtav ?>,
               
            }]
        }
		],
});
</script>      


<?
//smqr8 graph


 $rmon =  date('M, Y');
 
  $rmonqu =   date('Y-m');
 $rmonqufirst = $rmonqu.'-01';
  $rmonqufirstlast = $rmonqu.'-15';
   $rmonqulastfirst = $rmonqu.'-16';
$rmonqulast =   date("Y-m-t", strtotime($rmon));
 
 
 $name3 =  '1 to 15 '.$rmon;
 $name4 =  '16 to '. date("t", strtotime( date('M, Y'))).' '.$rmon;
 
 
 $pmon =   date('M, Y', strtotime(date('Y-m')." -1 month"));
 $pmonqu =   date('Y-m', strtotime(date('Y-m')." -1 month"));
 $pmonqufirst = $pmonqu.'-01';
  $pmonqufirstlast = $pmonqu.'-15';
   $pmonqulastfirst = $pmonqu.'-16';
$pmonqulast =   date("Y-m-t", strtotime($pmon));
 $name1 =  '1 to 15 '.$pmon;
$name2 =  '16 to '. date("t", strtotime($pmon)).' '.$pmon;

$name1q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqufirst."' and '".$pmonqufirstlast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00')")->count();

$name1rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqufirst."' and '".$pmonqufirstlast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00') ");
 $name1rt = $name1rtq->sum('response_time_duration');
  if($name1q)
 {
	$name1rtav =  round($name1rt /$name1q);
 }
 else
 {
	 $name1rtav = 0;
 }




$name2q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqulastfirst."' and '".$pmonqulast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00') ")->count();

$name2rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$pmonqulastfirst."' and '".$pmonqulast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00') ");
 $name2rt = $name2rtq->sum('response_time_duration');
  if($name2q)
 {
	$name2rtav =  round($name2rt /$name2q);
 }
 else
 {
	 $name2rtav = 0;
 }




$name3q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqufirst."' and '".$rmonqufirstlast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00') ")->count();

$name3rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqufirst."' and '".$rmonqufirstlast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00') ");
 $name3rt = $name3rtq->sum('response_time_duration');
  if($name3q)
 {
	$name3rtav =  round($name3rt /$name3q);
 }
 else
 {
	 $name3rtav = 0;
 }



$name4q  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqulastfirst."' and '".$rmonqulast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00') ")->count();

$name4rtq  = SocialMediaQuery::find()->where(" (response_datetime BETWEEN '".$rmonqulastfirst."' and '".$rmonqulast."') and (response_time BETWEEN '20:01' and '24:00' or response_time BETWEEN '01:01' and '09:00') ");
 $name4rt = $name4rtq->sum('response_time_duration');
 
 if($name4q)
 {
$name4rtav =  round($name4rt /$name4q);
 }
 else
 {
	 $name4rtav = 0;
 }



?>
<script>


Highcharts.chart('smqr8', {
   chart: {
            type: 'column'
        },
        title: {
            text: 'SM Query Response Time (8 PM - 9 AM)'
        },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: true
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },

        series: [{
            name: '<?=$name1?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name1q ?>,
               
            }, {
                name: 'response',
                y: <?=$name1rtav ?>,
               
            }]
        }, {
           name: '<?=$name2?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name2q ?>,
               
            }, {
                name: 'response',
                y: <?=$name2rtav ?>,
               
            }]
        },
		{
            name: '<?=$name3?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name3q ?>,
               
            }, {
                name: 'response',
                y: <?=$name3rtav ?>,
               
            }]
        }, {
           name: '<?=$name4?>',
            colorByPoint: false,
             colors: [
                '#00ff00',
                '#ED7D31',
               
            ],
            data: [{
                name: 'query',
                y: <?=$name4q ?>,
               
            }, {
                name: 'response',
                y: <?=$name4rtav ?>,
               
            }]
        }
		],
});
</script>      