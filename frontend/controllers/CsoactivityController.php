<?php

namespace frontend\controllers;

use Yii;
use app\models\CsoActivity;
use app\models\CsoActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\models\Customer;
use app\models\Zone;
use app\models\City;
use app\models\Location;
use app\models\ServiceLines;
use app\models\ServiceCategory;
use app\models\BpList;


/**
 * CsoactivityController implements the CRUD actions for CsoActivity model.
 */
class CsoactivityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CsoActivity models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new CsoActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single CsoActivity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "CsoActivity #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new CsoActivity model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new CsoActivity();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new CsoActivity",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
				
				$customercontact = $model->contact_number;
				
				$ase =  Customer::find()->where("contact_number='".$customercontact."'")->one();
				if(!$ase)
				{
					 $cus = new Customer();  
					 $cus->customer_name = $model->client_name;
					
					$cus->city = $model->city;
					$cus->zone = $model->zone;
					$cus->location = $model->location;
					$cus->address = $model->address;
					$cus->app_install = $model->apps_installed;
					$cus->call_number_source = $model->call_number_source;
					$cus->customers_type = $model->client_type;
					$cus->gender = $model->gender;
					$cus->customer_level = $model->customer_level;
					$cus->edit_date = date('Y-m-d');
					$cus->edit_by = $model->cso_name;
					$cus->save();					 
				}
				else
				{
					 $ase->customer_name = $model->client_name;
					
					$ase->city = $model->city;
					$ase->zone = $model->zone;
					$ase->location = $model->location;
					$ase->address = $model->address;
					
					$ase->call_number_source = $model->call_number_source;
					$ase->customers_type = $model->client_type;
					$ase->gender = $model->gender;
					$ase->customer_level = $model->customer_level;
					$ase->edit_date = date('Y-m-d');
					$ase->edit_by = $model->cso_name;
					$ase->save(false);	
					//echo 'dddd'; die();	
				}
				
				
				
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new CsoActivity",
                    'content'=>'<span class="text-success">Create CsoActivity success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new CsoActivity",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) ) {
				/*$city = $model->city;
				$cn = City::find()->where("id=".$city)->one();
				$model->city= $cn->name; 
				$zn = Zone::find()->where("id=".$model->zone)->one();
				$model->zone= $zn->name; 
				$ln = Location::find()->where("id=".$model->location)->one();
				$model->location= $ln->name; 
				$sc = ServiceCategory::find()->where("id=".$model->service_category)->one();
				$model->service_category= $sc->category; 
				$ln = ServiceLines::find()->where("id=".$model->service_line)->one();
				$model->service_line= $ln->lines; */
				
				if($model->assigned_bp_name)
				{
					$ln = BpList::find()->where("id=".$model->assigned_bp_name)->one();
					$model->assigned_bp_name= $ln->bp_name;
				$model->assigned_bp_number= $ln->mobile;
				}
				
				
				
				$callstart = $model->call_start_time;
				$callend = date('Y-m-d H:i:s');
				$model->call_end_time = $callend;
				
				$from_time = strtotime($callstart); 
				$to_time = strtotime($callend); 
				$diff_minutes = round(abs($from_time - $to_time) / 60,2). " mins";
				$model->call_duration = $diff_minutes;
				
				 $model->save();
				 
				 
				 
				 $customercontact = $model->contact_number;
				
				$ase =  Customer::find()->where("contact_number='".$customercontact."'")->one();
				if(!$ase)
				{
					 $cus = new Customer();  
					 $cus->customer_name = $model->client_name;
					$cus->contact_number = $model->contact_number;
					$cus->city = $model->city;
					$cus->zone = $model->zone;
					$cus->location = $model->location;
					$cus->address = $model->address;
					
					$cus->call_number_source = $model->call_number_source;
					$cus->customers_type = $model->client_type;
					$cus->gender = $model->gender;
					$cus->customer_level = $model->customer_level;
					$cus->added_date = date('Y-m-d');
					$cus->added_by = $model->cso_name;
					$cus->save();					 
				}
				else
				{
					 $ase->customer_name = $model->client_name;
					
					$ase->city = $model->city;
					$ase->zone = $model->zone;
					$ase->location = $model->location;
					$ase->address = $model->address;					
					$ase->call_number_source = $model->call_number_source;
					$ase->customers_type = $model->client_type;
					$ase->gender = $model->gender;
					$ase->customer_level = $model->customer_level;
					$ase->edit_date = date('Y-m-d');
					$ase->edit_by = $model->cso_name;
					$ase->app_install = 'No';
					$ase->save(false);	
					//echo 'dddd'; die();	
				}
				
				 
				 
				 
				 
				 
				 
				echo "<h3>Data has been saved successfully.</h3>"; exit();
              //  return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing CsoActivity model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update CsoActivity #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "CsoActivity #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update CsoActivity #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing CsoActivity model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing CsoActivity model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the CsoActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsoActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsoActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
           
            return ['output'=>$out, 'selected'=>''];
        }
    }
    return ['output'=>'', 'selected'=>''];
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

public function actionBpinfo() {
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $city = $parents[0];
            $out = self::getBpInfo($city); 
           
            return ['output'=>$out, 'selected'=>''];
        }
    }
    return ['output'=>'', 'selected'=>''];
}
public function getBpInfo($id)
{
$data = BpList::find()->where(['id'=>$id])->select(['id','mobile'])->asArray()->all();
$value = (count($data) == 0) ? ['' => ''] : $data;
if(count($data) > 0)
{
// var_dump($data);
$cityname = array();
$ci=0;
foreach ($data as $k2 => $v2) {
$cityname[$ci]['id']=$v2['id'];
$cityname[$ci]['name']=$v2['mobile'];
$ci++;
# code...
}
// var_dump($cityname);
return $cityname;
}
return $value;

}

public function beforeAction($action) 
{ 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
}
 	
}
