<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "allergy".
 *
 * @property integer $id
 * @property integer $allergy_type_id
 * @property integer $patient_id
 * @property string $notes
 * @property string $since
 *
 * @property AllergyType $allergyType
 * @property Patient $patient
 * @property PatientAllergy[] $patientAllergies
 */
class Allergy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'allergy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['allergy_type_id', 'patient_id'], 'required'],
            [['allergy_type_id', 'patient_id'], 'integer'],
            [['since'], 'safe'],
            [['notes'], 'string', 'max' => 2000],
            [['allergy_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AllergyType::className(), 'targetAttribute' => ['allergy_type_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'allergy_type_id' => Yii::t('app', 'Allergy Type ID'),
            'patient_id' => Yii::t('app', 'Patient ID'),
            'notes' => Yii::t('app', 'Notes'),
            'since' => Yii::t('app', 'Since'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllergyType()
    {
        return $this->hasOne(AllergyType::className(), ['id' => 'allergy_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientAllergies()
    {
        return $this->hasMany(PatientAllergy::className(), ['allergy_id' => 'id']);
    }
}
