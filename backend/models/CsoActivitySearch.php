<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CsoActivity;

/**
 * CsoActivitySearch represents the model behind the search form about `app\models\CsoActivity`.
 */
class CsoActivitySearch extends CsoActivity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['call_number_source', 'contact_number', 'client_name', 'client_type', 'gender', 'city', 'zone', 'location', 'call_date', 'cso_name', 'call_start_time', 'call_end_time', 'call_duration', 'call_status', 'call_type', 'notes', 'service_category', 'service_line', 'action', 'apointment_date', 'status', 'service_order_number', 'order_gateway', 'assigned_bp_name', 'assigned_bp_number', 'assigned_sp_name', 'assigned_sp_number', 'sp_quotation', 'negotiated_price', 'customer_agreed_price', 'demurrage', 'discount_amount', 'sp_service_charge', 'psl_service_charge', 'vat', 'total_invoice_amount', 'customer_level', 'dialer_id','address'], 'safe'],
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
        $query = CsoActivity::find();

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
            'call_date' => $this->call_date,
            'apointment_date' => $this->apointment_date,
        ]);

        $query->andFilterWhere(['like', 'call_number_source', $this->call_number_source])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'client_type', $this->client_type])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zone', $this->zone])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'cso_name', $this->cso_name])
            ->andFilterWhere(['like', 'call_start_time', $this->call_start_time])
            ->andFilterWhere(['like', 'call_end_time', $this->call_end_time])
            ->andFilterWhere(['like', 'call_duration', $this->call_duration])
            ->andFilterWhere(['like', 'call_status', $this->call_status])
            ->andFilterWhere(['like', 'call_type', $this->call_type])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'service_category', $this->service_category])
            ->andFilterWhere(['like', 'service_line', $this->service_line])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'service_order_number', $this->service_order_number])
            ->andFilterWhere(['like', 'order_gateway', $this->order_gateway])
            ->andFilterWhere(['like', 'assigned_bp_name', $this->assigned_bp_name])
            ->andFilterWhere(['like', 'assigned_bp_number', $this->assigned_bp_number])
            ->andFilterWhere(['like', 'assigned_sp_name', $this->assigned_sp_name])
            ->andFilterWhere(['like', 'assigned_sp_number', $this->assigned_sp_number])
            ->andFilterWhere(['like', 'sp_quotation', $this->sp_quotation])
            ->andFilterWhere(['like', 'negotiated_price', $this->negotiated_price])
            ->andFilterWhere(['like', 'customer_agreed_price', $this->customer_agreed_price])
            ->andFilterWhere(['like', 'demurrage', $this->demurrage])
            ->andFilterWhere(['like', 'discount_amount', $this->discount_amount])
            ->andFilterWhere(['like', 'sp_service_charge', $this->sp_service_charge])
            ->andFilterWhere(['like', 'psl_service_charge', $this->psl_service_charge])
            ->andFilterWhere(['like', 'vat', $this->vat])
            ->andFilterWhere(['like', 'total_invoice_amount', $this->total_invoice_amount])
            ->andFilterWhere(['like', 'customer_level', $this->customer_level])
			->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'dialer_id', $this->dialer_id]);

        return $dataProvider;
    }
}
