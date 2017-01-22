<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Patient;

/**
 * PatientSearch represents the model behind the search form about `app\models\Patient`.
 */
class PatientSearch extends Patient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'document_type_id', 'organization_id', 'picture_size'], 'integer'],
            [['first_name', 'last_name', 'document_id', 'birth_date', 'phone', 'address', 'email', 'celullar', 'picture', 'content_type', 'picture_name', 'decease_date'], 'safe'],
            [['weight', 'height'], 'number'],
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
        $query = Patient::find();

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
            'document_type_id' => $this->document_type_id,
            'birth_date' => $this->birth_date,
            'weight' => $this->weight,
            'height' => $this->height,
            'organization_id' => Yii::$app->session['medicalCenter'],//$this->organization_id,
            'picture_size' => $this->picture_size,
            'decease_date' => $this->decease_date,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'document_id', $this->document_id])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'celullar', $this->celullar])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'content_type', $this->content_type])
            ->andFilterWhere(['like', 'picture_name', $this->picture_name]);

        return $dataProvider;
    }
}
