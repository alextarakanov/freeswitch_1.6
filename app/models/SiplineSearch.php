<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sipline;

/**
 * SiplineSearch represents the model behind the search form of `app\models\Sipline`.
 */
class SiplineSearch extends Sipline
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['line_name', 'prefix', 'minute_set', 'minute_use', 'error_set', 'error_use', 'call_limit_set', 'call_limit_use', 'error_use_local'], 'integer'],
            [['time_try', 'time_success', 'state', 'comments', 'docker_contener'], 'safe'],
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
        $query = Sipline::find();

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
            'line_name' => $this->line_name,
            'prefix' => $this->prefix,
            'minute_set' => $this->minute_set,
            'minute_use' => $this->minute_use,
            'error_set' => $this->error_set,
            'error_use' => $this->error_use,
            'time_try' => $this->time_try,
            'time_success' => $this->time_success,
            'call_limit_set' => $this->call_limit_set,
            'call_limit_use' => $this->call_limit_use,
            'error_use_local' => $this->error_use_local,
        ]);

        $query->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'docker_contener', $this->docker_contener]);

        return $dataProvider;
    }
}
