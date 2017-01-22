<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "allergy_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $allergy_type_id
 * @property string $details
 *
 * @property Allergy[] $allergies
 * @property AllergyType $allergyType
 * @property AllergyType[] $allergyTypes
 */
class AllergyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'allergy_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['allergy_type_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['details'], 'string', 'max' => 2000],
            [['allergy_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AllergyType::className(), 'targetAttribute' => ['allergy_type_id' => 'id']],
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
            'allergy_type_id' => Yii::t('app', 'Allergy Type ID'),
            'details' => Yii::t('app', 'Details'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllergies()
    {
        return $this->hasMany(Allergy::className(), ['allergy_type_id' => 'id']);
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
    public function getAllergyTypes()
    {
        return $this->hasMany(AllergyType::className(), ['allergy_type_id' => 'id']);
    }
}
