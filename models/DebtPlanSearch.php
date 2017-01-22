<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DebtPlan;

/**
 * DebtPlanSearch represents the model behind the search form about `app\models\DebtPlan`.
 */
class DebtPlanSearch extends DebtPlan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patient_debt_id'], 'integer'],
            [['payment_date', 'paid_date', 'notes'], 'safe'],
            [['interest_amount', 'principal_amount', 'interest_paid', 'principal_paid'], 'number'],
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
        $query = DebtPlan::find();

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
            'patient_debt_id' => $this->patient_debt_id,
            'payment_date' => $this->payment_date,
            'interest_amount' => $this->interest_amount,
            'principal_amount' => $this->principal_amount,
            'interest_paid' => $this->interest_paid,
            'principal_paid' => $this->principal_paid,
            'paid_date' => $this->paid_date,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
