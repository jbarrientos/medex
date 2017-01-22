<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "patient".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $document_id
 * @property integer $document_type_id
 * @property string $birth_date
 * @property string $weight
 * @property string $height
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $celullar
 * @property integer $organization_id
 * @property string $picture
 * @property string $content_type
 * @property integer $picture_size
 * @property string $picture_name
 * @property string $decease_date
 * @property string $gender
 * @property integer $blood_type_id
 * @property string $allergies
 *
 * @property Allergy[] $allergies
 * @property Consultation[] $consultations
 * @property EmergencyContact[] $emergencyContacts
 * @property Organization $organization
 * @property PatientAllergy[] $patientAllergies
 * @property PatientDisease[] $patientDiseases
 * @property DocumentType $documentType
 * @property BloodType $bloodType
 */
class Patient extends \yii\db\ActiveRecord
{
    
    public $uploadedFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'birth_date', 'gender', 'blood_type_id'], 'required'],
            [['document_type_id', 'organization_id', 'picture_size'], 'integer'],
            [['birth_date', 'decease_date'], 'safe'],
            [['blood_type_id'],'safe'],
            [['weight', 'height'], 'number'],
            [['picture'], 'string'],[['allergies'],'safe'],
            [['gender'], 'string'],[['gender'],'safe'],
            [['first_name', 'last_name', 'address', 'email', 'content_type', 'picture_name'], 'string', 'max' => 100],
            [['document_id', 'phone', 'celullar'], 'string', 'max' => 20],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'document_id' => Yii::t('app', 'Document ID'),
            'document_type_id' => Yii::t('app', 'Document Type ID'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'weight' => Yii::t('app', 'Weight'),
            'height' => Yii::t('app', 'Height'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'celullar' => Yii::t('app', 'Celullar'),
            'organization_id' => Yii::t('app', 'Organization ID'),
            'picture' => Yii::t('app', 'Picture'),
            'content_type' => Yii::t('app', 'Content Type'),
            'picture_size' => Yii::t('app', 'Picture Size'),
            'picture_name' => Yii::t('app', 'Picture Name'),
            'decease_date' => Yii::t('app', 'Decease Date'),
            'gender'=>Yii::t('app', 'Gender'),
            'blood_type_id'=>Yii::t('app', 'Blood type'),
            'allergies'=>Yii::t('app','Allergies')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllergies()
    {
        return $this->hasMany(Allergy::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultations()
    {
        return $this->hasMany(Consultation::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmergencyContacts()
    {
        return $this->hasMany(EmergencyContact::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
    
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientAllergies()
    {
        return $this->hasMany(PatientAllergy::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientDiseases()
    {
        return $this->hasMany(PatientDisease::className(), ['patient_id' => 'id']);
    }
    
    
    public function getFullName(){
        return $this->first_name.  ' ' . $this->last_name;
    }
    
    public function beforeSave($insert){
            if($file = UploadedFile::getInstance($this,'uploadedFile'))
            {
                $this->picture_name=$file->name;
                $this->content_type=$file->type;
                $this->picture_size=$file->size;
                $this->picture=file_get_contents($file->tempName);
            }
            return parent::beforeSave($insert);
        }
    
}
