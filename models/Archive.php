<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "archive".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $archive_type_id
 * @property string $notes
 * @property string $document
 * @property integer $document_size
 * @property string $document_name
 * @property string $content_type
 * @property string $uploaded_date
 * @property integer $user_id
 * @property string $place
 * @property string $archive_date
 * @property string $responsible
 * @property string $contact_phone
 *
 * @property Patient $patient
 * @property ArchiveType $archiveType
 * @property User $user
 */
class Archive extends \yii\db\ActiveRecord
{
    
    public $uploadedFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'archive';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'archive_type_id'], 'required'],
            [['patient_id', 'archive_type_id', 'document_size', 'user_id'], 'integer'],
            [['document'], 'string'],
            [['uploaded_date'], 'safe'],[['place'], 'safe'],
            [['archive_date'], 'safe'],[['responsible'], 'safe'],[['contact_phone'], 'safe'],
            [['notes'], 'string', 'max' => 255],
            [['document_name', 'content_type'], 'string', 'max' => 100],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'id']],
            [['archive_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArchiveType::className(), 'targetAttribute' => ['archive_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'archive_type_id' => Yii::t('app', 'Archive Type ID'),
            'notes' => Yii::t('app', 'Notes'),
            'document' => Yii::t('app', 'Document'),
            'document_size' => Yii::t('app', 'Document Size'),
            'document_name' => Yii::t('app', 'Document Name'),
            'content_type' => Yii::t('app', 'Content Type'),
            'uploaded_date' => Yii::t('app', 'Uploaded Date'),
            'user_id' => Yii::t('app', 'User ID'),
            'place'=> Yii::t('app', 'Place'),
            'archive_date'=> Yii::t('app', 'Archive Date'),
            'responsible'=> Yii::t('app', 'Responsible'),
            'contact_phone'=> Yii::t('app', 'Contact Phone'),
            //'uploadedFile'=>Yii::t('app', 'Uploaded File'),
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
    public function getArchiveType()
    {
        return $this->hasOne(ArchiveType::className(), ['id' => 'archive_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function beforeSave($insert){
            if($file = UploadedFile::getInstance($this,'uploadedFile'))
            {
                $this->document_name=$file->name;
                $this->content_type=$file->type;
                $this->document_size=$file->size;
                $this->document=file_get_contents($file->tempName);
            }
            return parent::beforeSave($insert);
        }
}
