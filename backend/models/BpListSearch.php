<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BpList;

/**
 * BpListSearch represents the model behind the search form about `app\models\BpList`.
 */
class BpListSearch extends BpList
{
    /**
     * @inheritdoc
     */
	  public $moduleName;
    public function rules()
    {
        return [
            [['id', 'zone'], 'integer'],
            [['bp_name', 'mobile', 'moduleName'], 'safe'],
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
        $query = BpList::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			$query->joinWith(['zone']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'zone' => $this->zone,
        ]);

        $query->andFilterWhere(['like', 'bp_name', $this->bp_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);
			$query->joinWith(['modules'=>function ($q) {
        $q->where('zone.name LIKE "%' . 
            $this->moduleName . '%"');
    }]);

        return $dataProvider;
    }
}
