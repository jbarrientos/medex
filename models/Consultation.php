<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consultation".
 *
 * @property integer $id
 * @property string $consultation_date
 * @property integer $doctor_id
 * @property string $diagnosis
 * @property string $recomendation
 * @property string $notes
 * @property integer $patient_id
 * @property integer $disease_id
 * @property string $next_consultation
 * @property integer $next_doctor_id
 * @property string $status
 * @property integer $hour_id
 * @property integer $organization_id
 * @property string $cancelation_date
 * @property integer $cancelation_user_id
 * @property integer $user_id
 * @property integer $cancelation_type_id
 * @property string $cancelation_notes
 * @property string $prescription
 * @property string $weight
 *
 * @property Disease $disease
 * @property Doctor $doctor
 * @property Doctor $nextDoctor
 * @property Patient $patient
 * @property Hour $hour
 * @property Organization $organization
 * @property Prescription[] $prescriptions
 * @property CancelationType $cancelationType
 */
class Consultation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consultation_date', 'doctor_id', 'patient_id','hour_id','weight'], 'required'],
            [['consultation_date', 'next_consultation'], 'safe'],
            [['doctor_id', 'patient_id', 'disease_id', 'next_doctor_id'], 'integer'],
            [['status'],'safe'],
            [['hour_id'],'safe'],
            [['cancelation_date'],'safe'], 
            [['cancelation_user_id'],'safe'],
            [['user_id'],'safe'],
            [['organization_id'],'safe'],
            [['cancelation_type_id'],'safe'], 
            [['cancelation_notes'],'safe'],[['weight'],'safe'],
            [['prescription'],'safe'],
            [['diagnosis', 'recomendation', 'notes'], 'string', 'max' => 2000],
            [['disease_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disease::className(), 'targetAttribute' => ['disease_id' => 'id']],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::className(), 'targetAttribute' => ['doctor_id' => 'id']],
            [['next_doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::className(), 'targetAttribute' => ['next_doctor_id' => 'id']],
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
            'consultation_date' => Yii::t('app', 'Consultation Date'),
            'doctor_id' => Yii::t('app', 'Doctor ID'),
            'diagnosis' => Yii::t('app', 'Diagnosis'),
            'recomendation' => Yii::t('app', 'Recomendation'),
            'notes' => Yii::t('app', 'Notes'),
            'patient_id' => Yii::t('app', 'Patient ID'),
            'disease_id' => Yii::t('app', 'Disease ID'),
            'next_consultation' => Yii::t('app', 'Next Consultation'),
            'next_doctor_id' => Yii::t('app', 'Next Doctor ID'),
            'status'=>Yii::t('app','Status'),
            'hour_id'=>Yii::t('app','Hour'),
            'organization_id'=>Yii::t('app','Medical Center'),
            'cancelation_date'=>Yii::t('app','Cancelation Date'),
            'user_id'=>Yii::t('app','User'),
            'cancelation_user_id'=>Yii::t('app','Cancelation User'),
            'cancelation_type_id'=>Yii::t('app','Cancelation Type'),
            'cancelation_notes'=>Yii::t('app','Cancelation Notes'),
            'prescription'=>Yii::t('app','Prescription'),
            'weight'=>Yii::t('app','Weight'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisease()
    {
        return $this->hasOne(Disease::className(), ['id' => 'disease_id']);
    }
    
    public function getHour()
    {
        return $this->hasOne(Hour::className(), ['id' => 'hour_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
    }
    
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNextDoctor()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'next_doctor_id']);
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
    public function getPrescriptions()
    {
        return $this->hasMany(Prescription::className(), ['consultation_id' => 'id']);
    }
    
    public function getEndTime(){
        
        $duration = $this->patient->organization->consultation_time;
        $start = str_replace($this->hour->name,':','');
        $end = $start + $duration;
        if($end < 1000){
            return substr($end, 0,1).':'.substr($end, 1);
        }
        else{
            return substr($end, 0,2).':'.substr($end, 2);
        }
        
    }
    
    public function getStatus(){
        return ($this->status=='P' ? 'Pendiente' : ($this->status=='C' ? 'Cancelada' : 'Realizada'));
    }
}
