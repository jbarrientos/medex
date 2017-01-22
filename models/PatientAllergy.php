<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_allergy".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $allergy_id
 * @property string $notes
 *
 * @property Allergy $allergy
 * @property Patient $patient
 */
class PatientAllergy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_allergy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'allergy_id'], 'required'],
            [['patient_id', 'allergy_id'], 'integer'],
            [['notes'], 'string', 'max' => 2000],
            [['allergy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Allergy::className(), 'targetAttribute' => ['allergy_id' => 'id']],
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
            'allergy_id' => Yii::t('app', 'Allergy ID'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllergy()
    {
        return $this->hasOne(Allergy::className(), ['id' => 'allergy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }
}
