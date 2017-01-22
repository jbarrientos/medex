<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emergency_contact".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property string $contact_name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $relationship_id
 *
 * @property Patient $patient
 * @property Relationship $relationship
 */
class EmergencyContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emergency_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'contact_name'], 'required'],
            [['patient_id', 'relationship_id'], 'integer'],
            [['contact_name', 'email', 'address'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'id']],
            [['relationship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Relationship::className(), 'targetAttribute' => ['relationship_id' => 'id']],
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
            'contact_name' => Yii::t('app', 'Contact Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'relationship_id' => Yii::t('app', 'Relationship ID'),
        ];
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
    public function getRelationship()
    {
        return $this->hasOne(Relationship::className(), ['id' => 'relationship_id']);
    }
}
