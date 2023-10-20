<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserAccess;

/**
 * UserAccessSearch represents the model behind the search form about `app\models\UserAccess`.
 */
class UserAccessSearch extends UserAccess
{
    /**
     * @inheritdoc
     */
	   public $moduleName;
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['cname', 'actions', 'moduleName'], 'safe'],
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
        $query = UserAccess::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
				$query->joinWith(['user']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'cname', $this->cname])
            ->andFilterWhere(['like', 'actions', $this->actions]);
			$query->joinWith(['modules'=>function ($q) {
        $q->where('user.username LIKE "%' . 
            $this->moduleName . '%"');
    }]);
		

        return $dataProvider;
    }
}
