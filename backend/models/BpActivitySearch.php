<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BpActivity;

/**
 * BpActivitySearch represents the model behind the search form about `app\models\BpActivity`.
 */
class BpActivitySearch extends BpActivity
{
   public $moduleName;
	   public $zoneName;
	   public $sercatName;
	   public $serlineName;
	   /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bp_id', 'leaflet_distribution_number'], 'integer'],
            [['bp_name', 'assigned_person', 'date', 'week_day', 'company_name', 'clients_representative_name', 'clients_representative_number','customer_email', 'work_start_time', 'work_end_time', 'work_duration', 'city', 'zone', 'address', 'daily_status', 'assigned_activities', 'job_type', 'customers_categories', 'query_status', 'service_category', 'service_line', 'apps_installed', 'notes', 'moduleName','zoneName','sercatName','serlineName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BpActivity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
		  $dataProvider->setSort([        
        'defaultOrder' => [
            'id' => SORT_DESC
        ]
    	]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			$query->joinWith(['city']);
			$query->joinWith(['zone']);
			$query->joinWith(['service_category']);
			$query->joinWith(['service_lines']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'bp_id' => $this->bp_id,
            'date' => $this->date,
            'leaflet_distribution_number' => $this->leaflet_distribution_number,
        ]);

        $query->andFilterWhere(['like', 'bp_name', $this->bp_name])
            ->andFilterWhere(['like', 'assigned_person', $this->assigned_person])
            ->andFilterWhere(['like', 'week_day', $this->week_day])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'clients_representative_name', $this->clients_representative_name])
            ->andFilterWhere(['like', 'clients_representative_number', $this->clients_representative_number])
			->andFilterWhere(['like', 'customer_email', $this->customer_email])
            ->andFilterWhere(['like', 'work_start_time', $this->work_start_time])
            ->andFilterWhere(['like', 'work_end_time', $this->work_end_time])
            ->andFilterWhere(['like', 'work_duration', $this->work_duration])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zone', $this->zone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'daily_status', $this->daily_status])
            ->andFilterWhere(['like', 'assigned_activities', $this->assigned_activities])
            ->andFilterWhere(['like', 'job_type', $this->job_type])
            ->andFilterWhere(['like', 'customers_categories', $this->customers_categories])
            ->andFilterWhere(['like', 'query_status', $this->query_status])
            ->andFilterWhere(['like', 'service_category', $this->service_category])
            ->andFilterWhere(['like', 'service_line', $this->service_line])
            ->andFilterWhere(['like', 'apps_installed', $this->apps_installed])
            ->andFilterWhere(['like', 'notes', $this->notes]);
			
			$query->joinWith(['modules'=>function ($q) {
        $q->where('city.name LIKE "%' . 
            $this->moduleName . '%"');
    }]);
	$query->joinWith(['zones'=>function ($q) {
        $q->where('zone.name LIKE "%' . 
            $this->zoneName . '%"');
    }]);
	
	$query->joinWith(['sercat'=>function ($q) {
        $q->where('service_category.category LIKE "%' . 
            $this->sercatName . '%"');
    }]);
	$query->joinWith(['serline'=>function ($q) {
        $q->where('service_lines.lines LIKE "%' . 
            $this->sercatName . '%"');
    }]);


        return $dataProvider;
    }
	
	public function searchbp($params)
    {
        $query = BpActivity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
		  $dataProvider->setSort([        
        'defaultOrder' => [
            'id' => SORT_DESC
        ]
    	]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
              'bp_id' =>  \Yii::$app->session->get('user.bp_id'),
            'date' => $this->date,
            'leaflet_distribution_number' => $this->leaflet_distribution_number,
        ]);

        $query->andFilterWhere(['like', 'bp_name', $this->bp_name])
            ->andFilterWhere(['like', 'assigned_person', $this->assigned_person])
            ->andFilterWhere(['like', 'week_day', $this->week_day])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'clients_representative_name', $this->clients_representative_name])
            ->andFilterWhere(['like', 'clients_representative_number', $this->clients_representative_number])
            ->andFilterWhere(['like', 'work_start_time', $this->work_start_time])
            ->andFilterWhere(['like', 'work_end_time', $this->work_end_time])
            ->andFilterWhere(['like', 'work_duration', $this->work_duration])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zone', $this->zone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'daily_status', $this->daily_status])
            ->andFilterWhere(['like', 'assigned_activities', $this->assigned_activities])
            ->andFilterWhere(['like', 'job_type', $this->job_type])
            ->andFilterWhere(['like', 'customers_categories', $this->customers_categories])
            ->andFilterWhere(['like', 'query_status', $this->query_status])
            ->andFilterWhere(['like', 'service_category', $this->service_category])
            ->andFilterWhere(['like', 'service_line', $this->service_line])
            ->andFilterWhere(['like', 'apps_installed', $this->apps_installed])
            ->andFilterWhere(['like', 'notes', $this->notes]);
			
			$query->joinWith(['modules'=>function ($q) {
        $q->where('city.name LIKE "%' . 
            $this->moduleName . '%"');
    }]);
	$query->joinWith(['zones'=>function ($q) {
        $q->where('zone.name LIKE "%' . 
            $this->zoneName . '%"');
    }]);
	
	$query->joinWith(['serline'=>function ($q) {
        $q->where('service_lines.lines LIKE "%' . 
            $this->sercatName . '%"');
    }]);
	$query->joinWith(['sercat'=>function ($q) {
        $q->where('service_category.category LIKE "%' . 
            $this->sercatName . '%"');
    }]);
	

        return $dataProvider;
    }
}
