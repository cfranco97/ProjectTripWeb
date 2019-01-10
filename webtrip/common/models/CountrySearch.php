<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * CountrySearch represents the model behind the search form of `common\models\Country`.
 */
class CountrySearch extends Country
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_country'], 'integer'],
            [['name', 'id_continent','capital', 'population', 'cod', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Country::find();
        $query->joinWith(['continent']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_country' => $this->id_country,
        ]);

        $query->andFilterWhere(['like', 'country.name', $this->name])
            ->andFilterWhere(['like', 'capital', $this->capital])
            ->andFilterWhere(['like', 'population', $this->population])
            ->andFilterWhere(['like', 'cod', $this->cod])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'continent.name', $this->id_continent]);

        return $dataProvider;
    }
}
