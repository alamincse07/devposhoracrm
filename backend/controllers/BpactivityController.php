<?php

namespace backend\controllers;

use Yii;
use app\models\BpActivity;
use app\models\BpActivitySearch;
use app\models\Customer;
use app\models\City;
use app\models\Zone;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * BpactivityController implements the CRUD actions for BpActivity model.
 */
class BpactivityController extends Controller
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
     * Lists all BpActivity models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new BpActivitySearch();
		$sesdb =  Yii::$app->apu->sesdata('user_level');
		if($sesdb =='bp')
		{
       		$dataProvider = $searchModel->searchbp(Yii::$app->request->queryParams);
		}
		else
		{
			 $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		}

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single BpActivity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "SSO Activity #".$id,
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
     * Creates a new BpActivity model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new BpActivity();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new SSO Activity",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
              }else if($model->load($request->post()) && $model->validate()){
				  
				  	$qdt = str_replace('T',' ', $_REQUEST['qdate']);	
				 $model->work_start_time = $qdt;
				 
				 $rdt = str_replace('T',' ', $_REQUEST['rdate']);
				 $model->work_end_time = $rdt;
				 $model->week_day = date('l', strtotime($model->date));
			

				$from_time = strtotime($qdt); 
				$to_time = strtotime($rdt); 
				$diff_minutes = round(abs($from_time - $to_time) / 60,2);
				$model->work_duration = $diff_minutes;
				if($model->query_status =='Brand Query')
				{
					$model->service_category=1;$model->service_line=1;
				}
				$model->save(false);
				
				$customercontact = $model->clients_representative_number;
				
				$ase =  Customer::find()->where("contact_number='".$customercontact."'")->one();
				if(!$ase)
				{
					 $cus = new Customer();  
					 $cus->customer_name = $model->clients_representative_name;
					$cus->contact_number = $model->clients_representative_number;
					$cus->email = $model->customer_email;
					$cus->company_name = $model->company_name;
					$cus->customers_categories = $model->customers_categories;
					
					$cc = City::findOne($model->city);
					$zz = Zone::findOne($model->zone);
					$cus->city = $cc->name;
					$cus->zone = $zz->name;
					$cus->address = $model->address;
					$cus->app_install = $model->apps_installed;
					$cus->added_date = $model->date;
					$cus->added_by = $model->bp_name;
					$cus->save();					 
				}
				
				  
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new SSO Activity",
                    'content'=>'<span class="text-success">Create SSO Activity success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new SSO Activity",
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
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing BpActivity model.
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
                    'title'=> "Update SSO Activity #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->validate()){
				  
				  	$qdt = str_replace('T',' ', $_REQUEST['qdate']);	
				 $model->work_start_time = $qdt;
				 
				 $rdt = str_replace('T',' ', $_REQUEST['rdate']);
				 $model->work_end_time = $rdt;
				 $model->week_day = date('l', strtotime($model->date));
			

				$from_time = strtotime($qdt); 
				$to_time = strtotime($rdt); 
				$diff_minutes = round(abs($from_time - $to_time) / 60,2);
				$model->work_duration = $diff_minutes;
				if($model->query_status =='Brand Query')
				{
					$model->service_category=1;$model->service_line=1;
				}
				$model->save(false);
				
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "SSO Activity #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update SSO Activity #".$id,
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
     * Delete an existing BpActivity model.
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
     * Delete multiple existing BpActivity model.
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
     * Finds the BpActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BpActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BpActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
