<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceLines;

/**
 * ServiceLinesSearch represents the model behind the search form about `app\models\ServiceLines`.
 */
class ServiceLinesSearch extends ServiceLines
{
    /**
     * @inheritdoc
     */
	  public $moduleName;
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['lines', 'moduleName'], 'safe'],
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
        $query = ServiceLines::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			$query->joinWith(['service_category']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'lines', $this->lines]);
		$query->joinWith(['modules'=>function ($q) {
        $q->where('service_category.category LIKE "%' . 
            $this->moduleName . '%"');
    }]);

        return $dataProvider;
    }
}
