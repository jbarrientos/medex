<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_disease_note".
 *
 * @property integer $id
 * @property integer $doctor_id
 * @property string $notes
 * @property integer $patient_disease_id
 *
 * @property Doctor $doctor
 * @property PatientDisease $patientDisease
 */
class PatientDiseaseNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_disease_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'notes', 'patient_disease_id'], 'required'],
            [['doctor_id', 'patient_disease_id'], 'integer'],
            [['notes'], 'string', 'max' => 2000],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::className(), 'targetAttribute' => ['doctor_id' => 'id']],
            [['patient_disease_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientDisease::className(), 'targetAttribute' => ['patient_disease_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'doctor_id' => Yii::t('app', 'Doctor ID'),
            'notes' => Yii::t('app', 'Notes'),
            'patient_disease_id' => Yii::t('app', 'Patient Disease ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientDisease()
    {
        return $this->hasOne(PatientDisease::className(), ['id' => 'patient_disease_id']);
    }
}
