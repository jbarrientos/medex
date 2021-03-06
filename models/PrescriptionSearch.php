<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prescription;

/**
 * PrescriptionSearch represents the model behind the search form about `app\models\Prescription`.
 */
class PrescriptionSearch extends Prescription
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'consultation_id', 'user_id'], 'integer'],
            [['notes', 'modification_date', 'creation_date'], 'safe'],
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
        $query = Prescription::find();

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
            'consultation_id' => $this->consultation_id,
            'modification_date' => $this->modification_date,
            'creation_date' => $this->creation_date,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
