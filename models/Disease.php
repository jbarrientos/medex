<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disease".
 *
 * @property integer $id
 * @property string $name
 * @property integer $disease_id
 * @property string $code
 *
 * @property Consultation[] $consultations
 * @property Disease $disease
 * @property Disease[] $diseases
 * @property PatientDisease[] $patientDiseases
 */
class Disease extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disease';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['disease_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 10],
            [['disease_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disease::className(), 'targetAttribute' => ['disease_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'disease_id' => Yii::t('app', 'Disease ID'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultations()
    {
        return $this->hasMany(Consultation::className(), ['disease_id' => 'id']);
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
    public function getDiseases()
    {
        return $this->hasMany(Disease::className(), ['disease_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientDiseases()
    {
        return $this->hasMany(PatientDisease::className(), ['disease_id' => 'id']);
    }
}
