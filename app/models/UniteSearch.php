<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Unite;

/**
 * UniteSearch represents the model behind the search form of `app\models\Unite`.
 */
class UniteSearch extends Unite
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'setCountCallDay', 'useCountCallDay', 'setMinuteDay', 'useMinuteDay', 'setMinuteMonth', 'useMinuteMonth', 'setErrorDay', 'useErrorDay', 'totalCall', 'totalSeconds'], 'integer'],
            [['uniteID', 'server', 'stateLine', 'dateLastCall', 'dateLastSuccessCall', 'enable'], 'safe'],
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
        $query = Unite::find();

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
            'id' => $this->id,
            'setCountCallDay' => $this->setCountCallDay,
            'useCountCallDay' => $this->useCountCallDay,
            'setMinuteDay' => $this->setMinuteDay,
            'useMinuteDay' => $this->useMinuteDay,
            'setMinuteMonth' => $this->setMinuteMonth,
            'useMinuteMonth' => $this->useMinuteMonth,
            'setErrorDay' => $this->setErrorDay,
            'useErrorDay' => $this->useErrorDay,
            'dateLastCall' => $this->dateLastCall,
            'dateLastSuccessCall' => $this->dateLastSuccessCall,
            'totalCall' => $this->totalCall,
            'totalSeconds' => $this->totalSeconds,
        ]);

        $query->andFilterWhere(['like', 'uniteID', $this->uniteID])
            ->andFilterWhere(['like', 'server', $this->server])
            ->andFilterWhere(['like', 'stateLine', $this->stateLine])
            ->andFilterWhere(['like', 'enable', $this->enable]);

        return $dataProvider;
    }
}
