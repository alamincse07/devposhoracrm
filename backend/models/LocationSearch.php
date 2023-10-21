<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Location;

/**
 * LocationSearch represents the model behind the search form about `app\models\Location`.
 */
class LocationSearch extends Location
{
    /**
     * @inheritdoc
     */
	   public $moduleName;
	   public $zoneName;
    public function rules()
    {
        return [
            [['id', 'city_id', 'zone_id'], 'integer'],
            [['name', 'moduleName','zoneName'], 'safe'],
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
        $query = Location::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			$query->joinWith(['city']);
			$query->joinWith(['zone']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'city_id' => $this->city_id,
            'zone_id' => $this->zone_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
		$query->joinWith(['modules'=>function ($q) {
        $q->where('city.name LIKE "%' . 
            $this->moduleName . '%"');
    }]);
	$query->joinWith(['zone'=>function ($q) {
        $q->where('zone.name LIKE "%' . 
            $this->zoneName . '%"');
    }]);
		

        return $dataProvider;
    }
}
