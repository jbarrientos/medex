<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PatientDebt;

/**
 * PatientDebtSearch represents the model behind the search form about `app\models\PatientDebt`.
 */
class PatientDebtSearch extends PatientDebt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patient_id', 'num_months'], 'integer'],
            [['debt_date', 'first_payment', 'notes'], 'safe'],
            [['amount', 'ints_rate'], 'number'],
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
        $query = PatientDebt::find();

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
            'patient_id' => $this->patient_id,
            'debt_date' => $this->debt_date,
            'amount' => $this->amount,
            'first_payment' => $this->first_payment,
            'num_months' => $this->num_months,
            'ints_rate' => $this->ints_rate,
            'organization_id' => Yii::$app->session['medicalCenter'],//$this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
