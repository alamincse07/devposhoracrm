<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CsoOtherTarget;

/**
 * CsoOtherTargetSearch represents the model behind the search form about `app\models\CsoOtherTarget`.
 */
class CsoOtherTargetSearch extends CsoOtherTarget
{
    /**
     * @inheritdoc
     */
	  public $moduleName;
    public function rules()
    {
        return [
            [['id', 'cso_id', 'sales_conversion_target', 'sales_amount_target', 'call_target'], 'integer'],
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
        $query = CsoOtherTarget::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			$query->joinWith(['cso_list']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'target_from' => $this->target_from,
            'target_to' => $this->target_to,
            'cso_id' => $this->cso_id,
            'sales_conversion_target' => $this->sales_conversion_target,
            'sales_amount_target' => $this->sales_amount_target,
            'call_target' => $this->call_target,
        ]);

        $query->andFilterWhere(['like', 'target_daterange', $this->target_daterange]);
		$query->joinWith(['modules'=>function ($q) {
        $q->where('cso_list.cso_name LIKE "%' . 
            $this->moduleName . '%"');
    }]);
		

        return $dataProvider;
    }
}
