<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Zone;

/**
 * ZoneSearch represents the model behind the search form about `app\models\Zone`.
 */
class ZoneSearch extends Zone
{
    /**
     * @inheritdoc
     */
	  public $moduleName;
    public function rules()
    {
        return [
            [['id', 'city_id'], 'integer'],
            [['name', 'moduleName'], 'safe'],
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
        $query = Zone::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			$query->joinWith(['city']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'city_id' => $this->city_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
		$query->joinWith(['modules'=>function ($q) {
        $q->where('city.name LIKE "%' . 
            $this->moduleName . '%"');
    }]);
		

        return $dataProvider;
    }
}
