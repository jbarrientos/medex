<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmergencyContact;

/**
 * EmergencyContactTypeSearch represents the model behind the search form about `app\models\EmergencyContact`.
 */
class EmergencyContactTypeSearch extends EmergencyContact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patient_id', 'relationship_id'], 'integer'],
            [['contact_name', 'email', 'phone', 'address'], 'safe'],
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
        $query = EmergencyContact::find();

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
            'relationship_id' => $this->relationship_id,
        ]);

        $query->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
