<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Consultation;

/**
 * ConsultationSearch represents the model behind the search form about `app\models\Consultation`.
 */
class ConsultationSearch extends Consultation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doctor_id', 'patient_id', 'disease_id', 'next_doctor_id'], 'integer'],
            [['consultation_date', 'diagnosis', 'recomendation', 'notes', 'next_consultation'], 'safe'],
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
        $query = Consultation::find();

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
            'consultation_date' => $this->consultation_date,
            'doctor_id' => $this->doctor_id,
            'patient_id' => $this->patient_id,
            'disease_id' => $this->disease_id,
            'next_consultation' => $this->next_consultation,
            'next_doctor_id' => $this->next_doctor_id,
            'organization_id'=>Yii::$app->session['medicalCenter']
        ]);

        $query->andFilterWhere(['like', 'diagnosis', $this->diagnosis])
            ->andFilterWhere(['like', 'recomendation', $this->recomendation])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
