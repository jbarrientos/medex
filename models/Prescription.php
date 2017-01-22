<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prescription".
 *
 * @property integer $id
 * @property integer $consultation_id
 * @property string $notes
 * @property string $modification_date
 * @property string $creation_date
 * @property integer $user_id
 *
 * @property Consultation $consultation
 * @property User $user
 */
class Prescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prescription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consultation_id', 'notes', 'creation_date', 'user_id'], 'required'],
            [['consultation_id', 'user_id'], 'integer'],
            [['modification_date', 'creation_date'], 'safe'],
            [['notes'], 'string', 'max' => 2000],
            [['consultation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consultation::className(), 'targetAttribute' => ['consultation_id' => 'id']],
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
            'consultation_id' => Yii::t('app', 'Consultation ID'),
            'notes' => Yii::t('app', 'Notes'),
            'modification_date' => Yii::t('app', 'Modification Date'),
            'creation_date' => Yii::t('app', 'Creation Date'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultation()
    {
        return $this->hasOne(Consultation::className(), ['id' => 'consultation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
