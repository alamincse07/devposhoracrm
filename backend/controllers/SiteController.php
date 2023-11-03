<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\CsvForm;
use app\models\Actions;
use yii\web\UploadedFile;
use app\models\UploadMultiForm;
use app\modules\appadmin\models\Companies;
use app\modules\appadmin\models\UserCompanies;
use app\models\Zone;
use app\models\City;
use app\models\Location;
use app\models\ServiceLines;
use app\models\ServiceCategory;
use app\models\CsoActivity;
use app\models\BpActivity;

/**
 * Site controller
 */
class SiteController extends Controller
{
    

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       
	    $sesdb =  Yii::$app->apu->sesdata('user_level');
		if($sesdb =='')
		  {
				session_destroy(); 
				return $this->redirect(['login']);
		  }
		  elseif($sesdb =='supadmin' )
		  {
			  
			  if(isset($_REQUEST['filter']))
				{
					$start_date = $_REQUEST['start_date'];
					$end_date = $_REQUEST['end_date'];
				}
				else
				{
					$start_date = date('Y-m-01');
					$end_date = date('Y-m-t');
				}
				
				return $this->render('index',['from' => $start_date,'to'=>$end_date]);
				
		
		  }
		   elseif($sesdb =='bp' or $sesdb =='cso')
		  {
				
			//	\Yii::$app->session->set('user.companyid','');
			return $this->render('indexbp');
		  }
		  else
		  {
				session_destroy(); 
				return $this->redirect(['login']);
		  }
		  
    }
	
	
	

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
      
		$this->layout = 'login';
		$sesdb =  Yii::$app->apu->sesdata('user_level');
		if($sesdb !='')
		{
		  
		 if($sesdb =='supadmin' or $sesdb =='bp' )
		  {
				session_destroy(); 
				return $this->redirect(['login']);
		  }
		  else
		  {
			  
			 return $this->redirect(['index']); 
		  }
		  
		  
		  
		}else{

			if(isset($_REQUEST['login']))
			{
				$username = $_REQUEST['username'];
				$password = $_REQUEST['password'];
				$connection = \Yii::$app->db;
				$hotjobs = $connection->createCommand("SELECT * FROM user where username='".$username."' and password='".$password."'");
				$hjs = $hotjobs->queryOne();
				

				if($hjs)
				{ 
					if($hjs['status']==10)
					{
						\Yii::$app->session->set('user.username',$username); 
					
					   //	\Yii::$app->session->set('user.project_id',$hjs['project_id']);
						\Yii::$app->session->set('user.user_level',$hjs['user_level']);
						\Yii::$app->session->set('user.bp_id',$hjs['bp_id']);
						if($hjs['cso_id'])
						{
							
							$cs = $connection->createCommand("SELECT * FROM cso_list where id=".$hjs['cso_id']);
							$css = $cs->queryOne();
							\Yii::$app->session->set('user.cso_name',$css['cso_name']);
						}
						
						return $this->redirect(['index']);
						
						
					}
					else
					{
						$session = Yii::$app->session;
						
						// set a flash message named as "loginerror"
						$session->setFlash('loginerror', 'Inactive User');
						return $this->render('login');
					}
					
				}
				else
				{ 
					$session = Yii::$app->session;
						
						// set a flash message named as "loginerror"
					$session->setFlash('loginerror', 'Invalid Username or Password');
					return $this->render('login');
				}
			}
			else
			{
				return $this->render('login');
			}

		}
		
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
       // Yii::$app->user->logout();

       // return $this->goHome();
	   	session_destroy(); 
		return $this->redirect(['login']);
	   
    }
	
	

public function beforeAction($action)
	{
		$this->enableCsrfValidation = false; 
		if (parent::beforeAction($action)) {
			// change layout for error action
			if ($action->id=='error')
				 $this->layout ='error';
			return true;
		} else {
			return false;
		}
	}
		
public function actionZone() {
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $city = $parents[0];
            $out = self::getSubCatList($city); 
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
            return ['output'=>$out, 'selected'=>''];
        }
    }
    return ['output'=>'', 'selected'=>''];
}

public function getSubCatList($id)
{
$data = Zone::find()->where(['city_id'=>$id])->select(['id','name'])->asArray()->all();
$value = (count($data) == 0) ? ['' => ''] : $data;
if(count($data) > 0)
{
// var_dump($data);
$cityname = array();
$ci=0;
foreach ($data as $k2 => $v2) {
$cityname[$ci]['id']=$v2['id'];
$cityname[$ci]['name']=$v2['name'];
$ci++;
# code...
}
// var_dump($cityname);
return $cityname;
}
return $value;

}

public function actionLocation() {
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $ids = $_POST['depdrop_parents'];
        $city = empty($ids[0]) ? null : $ids[0];
        $zone = empty($ids[1]) ? null : $ids[1];
        if ($city != null) {
           $out = self::getProdList($city, $zone);
         
           return ['output'=>$out, 'selected'=>''];
        }
    }
    return ['output'=>'', 'selected'=>'0000'];
}

public function getProdList($id,$sid)
{
$data = Location::find()->where(['city_id'=>$id,'zone_id'=>$sid])->select(['id','name'])->asArray()->all();
$value = (count($data) == 0) ? ['' => ''] : $data;
if(count($data) > 0)
{
// var_dump($data);
$locationname = array();
$ci=0;
foreach ($data as $k2 => $v2) {
$locationname[$ci]['id']=$v2['id'];
$locationname[$ci]['name']=$v2['name'];
$ci++;
# code...
}
// var_dump($cityname);
return $locationname;
}
return $value;

}


public function actionServicelines() {
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $city = $parents[0];
            $out = self::getSubLines($city); 
           
            return ['output'=>$out, 'selected'=>''];
        }
    }
    return ['output'=>'', 'selected'=>''];
}
public function getSubLines($id)
{
$data = ServiceLines::find()->where(['category_id'=>$id])->select(['id','lines'])->asArray()->all();
$value = (count($data) == 0) ? ['' => ''] : $data;
if(count($data) > 0)
{
// var_dump($data);
$cityname = array();
$ci=0;
foreach ($data as $k2 => $v2) {
$cityname[$ci]['id']=$v2['id'];
$cityname[$ci]['name']=$v2['lines'];
$ci++;
# code...
}
// var_dump($cityname);
return $cityname;
}
return $value;

}

  public function actionCsoreports()
    {

		$sesdb =  Yii::$app->apu->sesdata('username');
		if($sesdb !='')
		{
			if(isset($_REQUEST['callsmqstatus']))
			{

					 return $this->renderAjax('callsmqstatus', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}
			elseif(isset($_REQUEST['salesstatus']))
			{

					 return $this->renderAjax('salesstatus', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}
			elseif(isset($_REQUEST['servicestatus']))
			{

					 return $this->renderAjax('servicestatus', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}
			elseif(isset($_REQUEST['socialmedia']))
			{

					 return $this->renderAjax('socialmedia', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}
			elseif(isset($_REQUEST['csodata']))
			{

					 return $this->renderAjax('csodata', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}
			elseif(isset($_REQUEST['socialdata']))
			{

					 return $this->renderAjax('socialdata', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}
			else
			{
				return $this->render('csoreports');
				
			}
		}else{
			
			session_destroy(); 
				return $this->redirect(['login']);
		}
		
    }
	
	public function actionSsrreports()
    {

		$sesdb =  Yii::$app->apu->sesdata('username');
		if($sesdb !='')
		{
			if(isset($_REQUEST['ssoactivitiesstatus']))
			{

					 return $this->renderAjax('ssractivitiesstatus', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}			
			elseif(isset($_REQUEST['ssodownload']))
			{

					 return $this->renderAjax('ssodownload', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}			
			else
			{
				return $this->render('ssrreports');
				
			}
		}else{
			
			session_destroy(); 
				return $this->redirect(['login']);
		}
		
    }
	
	public function actionSalesreports()
    {

		$sesdb =  Yii::$app->apu->sesdata('username');
		if($sesdb !='')
		{
			if(isset($_REQUEST['salesstatus']))
			{

					 return $this->renderAjax('salesactivityreports', ['target_from' =>$_REQUEST['start_date'],'target_to' =>$_REQUEST['end_date'],]);
			}			
						
			else
			{
				return $this->render('salesreports');
				
			}
		}else{
			
			session_destroy(); 
				return $this->redirect(['login']);
		}
		
    }
	
}
