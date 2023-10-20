<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `app\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['customer_name', 'contact_number', 'company_name', 'email', 'call_number_source', 'customers_type', 'customers_categories', 'gender', 'city', 'zone', 'location', 'address', 'app_install', 'customer_level', 'added_date', 'added_by', 'edit_date', 'edit_by'], 'safe'],
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
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		  $this->load($params);
		  $dataProvider->setSort([        
        'defaultOrder' => [
            'id' => SORT_DESC
        ]
    	]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'added_date' => $this->added_date,
            'edit_date' => $this->edit_date,
        ]);

        $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'call_number_source', $this->call_number_source])
            ->andFilterWhere(['like', 'customers_type', $this->customers_type])
            ->andFilterWhere(['like', 'customers_categories', $this->customers_categories])
			->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zone', $this->zone])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'app_install', $this->app_install])
            ->andFilterWhere(['like', 'customer_level', $this->customer_level])
            ->andFilterWhere(['like', 'added_by', $this->added_by])
            ->andFilterWhere(['like', 'edit_by', $this->edit_by]);

        return $dataProvider;
    }
}
