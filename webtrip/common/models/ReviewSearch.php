<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReviewSearch represents the model behind the search form of `common\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_review', 'id_trip'], 'integer'],
            [['rating'], 'number'],
            [['message','id_user','id_country'], 'safe'],
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
        $query = Review::find();
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
            'id_review' => $this->id_review,
            'rating' => $this->rating,
            'id_trip' => $this->id_trip,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
              ->andFilterWhere(['like', 'country.name', $this->id_country])
              ->andFilterWhere(['like', 'user.username', $this->id_user]);

        return $dataProvider;
    }
}
