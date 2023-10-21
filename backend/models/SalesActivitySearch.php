<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesActivity;

/**
 * SalesActivitySearch represents the model behind the search form about `app\models\SalesActivity`.
 */
class SalesActivitySearch extends SalesActivity
{
	 public $sercatName;
	   public $serlineName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['invoice_no', 'invoice_date', 'sales_catagories', 'service_order_gateway', 'service_date', 'services_category', 'services_line', 'company_name_b2b', 'customer_name', 'customer_mobile', 'customer_email', 'customer_address', 'sp_name', 'sp_cell_number', 'city', 'location', 'address', 'mode_of_payments',  'receiver_name',  'field_representative', 'name_of_representative', 'poshora_received_date', 'remarks','sales_status','zone', 'added_date', 'added_by', 'edit_date', 'edit_by', 'sercatName','serlineName' ], 'safe'],
            [['invoice_bill', 'ssl_charge', 'vat', 'service_charge', 'ssl_charge_factoring', 'poshora_charge', 'sp_service_charges', 'poshora_received', 'additional_received', 'sp_spare_parts', 'sp_discount_demurrage', 'poshora_spare_parts', 'poshora_discount_demurrage', 'net_bill_claimed', 'deduction_vat', 'deduction_ait', 'net_paid'], 'number'],
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
        $query = SalesActivity::find();

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
			'added_date' => $this->added_date,
            'edit_date' => $this->edit_date,
            'customer_id' => $this->customer_id,
            'invoice_date' => $this->invoice_date,
            'service_date' => $this->service_date,
            'poshora_received_date' => $this->poshora_received_date,
            'invoice_bill' => $this->invoice_bill,
            'ssl_charge' => $this->ssl_charge,
            'vat' => $this->vat,
            'service_charge' => $this->service_charge,
            'ssl_charge_factoring' => $this->ssl_charge_factoring,
            'poshora_charge' => $this->poshora_charge,
            'sp_service_charges' => $this->sp_service_charges,
            'poshora_received' => $this->poshora_received,
            'additional_received' => $this->additional_received,
            'sp_spare_parts' => $this->sp_spare_parts,
            'sp_discount_demurrage' => $this->sp_discount_demurrage,
            'poshora_spare_parts' => $this->poshora_spare_parts,
            'poshora_discount_demurrage' => $this->poshora_discount_demurrage,
            'net_bill_claimed' => $this->net_bill_claimed,
            'deduction_vat' => $this->deduction_vat,
            'deduction_ait' => $this->deduction_ait,
            'net_paid' => $this->net_paid,
        ]);

        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
            ->andFilterWhere(['like', 'sales_catagories', $this->sales_catagories])
            ->andFilterWhere(['like', 'service_order_gateway', $this->service_order_gateway])
            ->andFilterWhere(['like', 'services_category', $this->services_category])
            ->andFilterWhere(['like', 'services_line', $this->services_line])
            ->andFilterWhere(['like', 'company_name_b2b', $this->company_name_b2b])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'customer_mobile', $this->customer_mobile])
            ->andFilterWhere(['like', 'customer_email', $this->customer_email])
            ->andFilterWhere(['like', 'customer_address', $this->customer_address])
            ->andFilterWhere(['like', 'sp_name', $this->sp_name])
            ->andFilterWhere(['like', 'sp_cell_number', $this->sp_cell_number])
            ->andFilterWhere(['like', 'city', $this->city])
			 ->andFilterWhere(['like', 'zone', $this->zone])
			  ->andFilterWhere(['like', 'sales_status', $this->sales_status])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mode_of_payments', $this->mode_of_payments])
			 ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
			  ->andFilterWhere(['like', 'field_representative', $this->field_representative])
            ->andFilterWhere(['like', 'name_of_representative', $this->name_of_representative])
			->andFilterWhere(['like', 'added_by', $this->added_by])
            ->andFilterWhere(['like', 'edit_by', $this->edit_by])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);
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
