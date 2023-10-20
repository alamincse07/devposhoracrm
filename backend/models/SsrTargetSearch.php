<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SsrTarget;

/**
 * SsrTargetSearch represents the model behind the search form about `app\models\SsrTarget`.
 */
class SsrTargetSearch extends SsrTarget
{
    /**
     * @inheritdoc
     */
	 public $moduleName;
    public function rules()
    {
        return [
            [['id', 'ssr_id', 'spot_sales_target', 'spot_sales_amount_target', 'sp_sourcing_in_hand_target', 'client_visit_for_service_assess_target', 'client_visit_during_service_target'], 'integer'],
            [['target_from', 'target_to', 'target_daterange','moduleName'], 'safe'],
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
        $query = SsrTarget::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			$query->joinWith(['bp_list']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'target_from' => $this->target_from,
            'target_to' => $this->target_to,
            'ssr_id' => $this->ssr_id,
            'spot_sales_target' => $this->spot_sales_target,
            'spot_sales_amount_target' => $this->spot_sales_amount_target,
            'sp_sourcing_in_hand_target' => $this->sp_sourcing_in_hand_target,
            'client_visit_for_service_assess_target' => $this->client_visit_for_service_assess_target,
            'client_visit_during_service_target' => $this->client_visit_during_service_target,
        ]);
		$query->joinWith(['modules'=>function ($q) {
        $q->where('bp_list.bp_name LIKE "%' . 
            $this->moduleName . '%"');
    }]);

        $query->andFilterWhere(['like', 'target_daterange', $this->target_daterange]);

        return $dataProvider;
    }
}
