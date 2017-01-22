<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_disease".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $disease_id
 * @property string $status
 *
 * @property Disease $disease
 * @property Patient $patient
 * @property PatientDiseaseNote[] $patientDiseaseNotes
 */
class PatientDisease extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_disease';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'disease_id', 'status'], 'required'],
            [['patient_id', 'disease_id'], 'integer'],
            [['status'], 'string', 'max' => 5],
            [['disease_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disease::className(), 'targetAttribute' => ['disease_id' => 'id']],
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
            'patient_id' => Yii::t('app', 'Patient ID'),
            'disease_id' => Yii::t('app', 'Disease ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisease()
    {
        return $this->hasOne(Disease::className(), ['id' => 'disease_id']);
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
    public function getPatientDiseaseNotes()
    {
        return $this->hasMany(PatientDiseaseNote::className(), ['patient_disease_id' => 'id']);
    }
}
