<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Trip;

/**
 * TripSearch represents the model behind the search form of `common\models\Trip`.
 */
class TripSearch extends Trip
{
    /**
     * {@inheritdoc}
     */
    public $user;
    public $country;

    public function rules()
    {
        return [
            [['id_trip'], 'integer'],
            [['id_country','id_user','startdate', 'enddate', 'notes'], 'safe'],
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
        $query = Trip::find();
        $query->joinWith(['country']);
        $query->joinWith(['user']);

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
            'id_trip' => $this->id_trip,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'country.name', $this->id_country])
        ->andFilterWhere(['like', 'user.username', $this->id_user]);
        return $dataProvider;
    }
}
