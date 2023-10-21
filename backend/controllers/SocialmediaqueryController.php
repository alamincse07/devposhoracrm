<?php

namespace backend\controllers;
use Yii;
use app\models\SocialMediaQuery;
use app\models\SocialMediaQuerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * SocialmediaqueryController implements the CRUD actions for SocialMediaQuery model.
 */
class SocialmediaqueryController extends Controller
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
     * Lists all SocialMediaQuery models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SocialMediaQuerySearch();
		$sesdb =  Yii::$app->apu->sesdata('user_level');
		if($sesdb =='cso')
		{
       		 $dataProvider = $searchModel->searchcso(Yii::$app->request->queryParams);
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
     * Displays a single SocialMediaQuery model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "SocialMediaQuery #".$id,
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
     * Creates a new SocialMediaQuery model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new SocialMediaQuery();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new SocialMediaQuery",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
           }else if($model->load($request->post()) && $model->validate()){
			 //  $mm  = $this->findModel( $model->id);      && $model->save()
			 
				if(!$model->service_category)
				{
					$model->service_category=1;
				}
				if(!$model->service_line)
				{
					$model->service_line=1;
				}
				
				//$qdt = str_replace(' : ',' ', $mm->query_datetime);			
				$qdt = str_replace('T',' ', $_REQUEST['qdate']);	
				 $model->query_datetime = $qdt;
				 $qvang = explode('T',$_REQUEST['qdate']);
				  $model->query_date = $qvang[0];
				   $model->query_time = $qvang[1];
				// $rdt = str_replace(' : ',' ', $mm->response_datetime);				
				$rdt = str_replace('T',' ', $_REQUEST['rdate']);
				 $model->response_datetime = $rdt;
				  $rvang = explode('T',$_REQUEST['rdate']);
				  $model->response_date = $rvang[0];
				   $model->response_time = $rvang[1];
				 $from_time = strtotime($qdt); 
				$to_time = strtotime($rdt); 
				$diff_minutes = round(abs($from_time - $to_time) / 60,2);
				$model->response_time_duration = $diff_minutes;
				
		 $qdate = $_REQUEST['qdate'];
			
		$model->save(false);
				 

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new SocialMediaQuery",
                    'content'=>'<span class="text-success">Create SocialMediaQuery success</span>'.  $model->service_line,
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new SocialMediaQuery",
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
     * Updates an existing SocialMediaQuery model.
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
                    'title'=> "Update SocialMediaQuery #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->validate()){
			 //  $mm  = $this->findModel( $model->id);      && $model->save()
			 
				
				//$qdt = str_replace(' : ',' ', $mm->query_datetime);			
				$qdt = str_replace('T',' ', $_REQUEST['qdate']);	
				 $model->query_datetime = $qdt;
				 $qvang = explode('T',$_REQUEST['qdate']);
				  $model->query_date = $qvang[0];
				   $model->query_time = $qvang[1];
				// $rdt = str_replace(' : ',' ', $mm->response_datetime);				
				$rdt = str_replace('T',' ', $_REQUEST['rdate']);
				 $model->response_datetime = $rdt;
				  $rvang = explode('T',$_REQUEST['rdate']);
				  $model->response_date = $rvang[0];
				   $model->response_time = $rvang[1];
				 $from_time = strtotime($qdt); 
				$to_time = strtotime($rdt); 
				$diff_minutes = round(abs($from_time - $to_time) / 60,2);
				$model->response_time_duration = $diff_minutes;
				
		 $qdate = $_REQUEST['qdate'];
			
		$model->save(false);
		
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "SocialMediaQuery #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update SocialMediaQuery #".$id,
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
     * Delete an existing SocialMediaQuery model.
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
     * Delete multiple existing SocialMediaQuery model.
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
     * Finds the SocialMediaQuery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SocialMediaQuery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SocialMediaQuery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
