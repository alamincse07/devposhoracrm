<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CsoCallSourceTarget;

/**
 * CsoCallSourceTargetSearch represents the model behind the search form about `app\models\CsoCallSourceTarget`.
 */
class CsoCallSourceTargetSearch extends CsoCallSourceTarget
{
    /**
     * @inheritdoc
     */
	 public $moduleName;
    public function rules()
    {
        return [
            [['id', 'cso_id', 'target'], 'integer'],
            [['target_from', 'target_to', 'target_daterange', 'call_source', 'moduleName'], 'safe'],
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
        $query = CsoCallSourceTarget::find();

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
            'target' => $this->target,
        ]);

        $query->andFilterWhere(['like', 'target_daterange', $this->target_daterange])
            ->andFilterWhere(['like', 'call_source', $this->call_source]);
			$query->joinWith(['modules'=>function ($q) {
        $q->where('cso_list.cso_name LIKE "%' . 
            $this->moduleName . '%"');
    }]);

        return $dataProvider;
    }
}
