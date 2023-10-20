<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SocialMediaQuery;

/**
 * SocialMediaQuerySearch represents the model behind the search form about `app\models\SocialMediaQuery`.
 */
class SocialMediaQuerySearch extends SocialMediaQuery
{
    /**
     * @inheritdoc
     */
	   public $sercatName;
	   public $serlineName;
    public function rules()
    {
        return [
            [['id'], 'integer'],
           [['name','query_datetime', 'response_datetime','query_date', 'response_date','query_time', 'response_time','service_category', 'service_line','mobile','sercatName','cso_name','serlineName','query_type',  'query_details', 'category','media'], 'safe'],
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
        $query = SocialMediaQuery::find();

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
			$query->joinWith(['service_category']);
			$query->joinWith(['service_lines']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'query_datetime' => $this->query_datetime,
            'response_datetime' => $this->response_datetime,
			 'query_date' => $this->query_date,
            'response_date' => $this->response_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'query_type', $this->query_type])
            ->andFilterWhere(['like', 'query_details', $this->query_details])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'hide_del_ban', $this->hide_del_ban])
            ->andFilterWhere(['like', 'query_time', $this->query_time])
			 ->andFilterWhere(['like', 'response_time', $this->response_time])
			    ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'response_time_duration', $this->response_time_duration])
			  ->andFilterWhere(['like', 'query_details', $this->query_details])
			   ->andFilterWhere(['like', 'query_type', $this->query_type])
			    ->andFilterWhere(['like', 'category', $this->category])
			 ->andFilterWhere(['like', 'cso_name', $this->cso_name])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'media', $this->media]);
			
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
	
	 public function searchcso($params)
    {
        $query = SocialMediaQuery::find();

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
			$query->joinWith(['service_category']);
			$query->joinWith(['service_lines']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'query_datetime' => $this->query_datetime,
            'response_datetime' => $this->response_datetime,
			 'query_date' => $this->query_date,
            'response_date' => $this->response_date,
			 'cso_name' =>  \Yii::$app->session->get('user.cso_name'),
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'query_type', $this->query_type])
            ->andFilterWhere(['like', 'query_details', $this->query_details])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'hide_del_ban', $this->hide_del_ban])
            ->andFilterWhere(['like', 'query_time', $this->query_time])
			 ->andFilterWhere(['like', 'response_time', $this->response_time])
			    ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'response_time_duration', $this->response_time_duration])
			  ->andFilterWhere(['like', 'query_details', $this->query_details])
			   ->andFilterWhere(['like', 'query_type', $this->query_type])
			    ->andFilterWhere(['like', 'category', $this->category])
		//	 ->andFilterWhere(['like', 'cso_name', $this->cso_name])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'media', $this->media]);
			
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
}
