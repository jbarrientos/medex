<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "debt_plan".
 *
 * @property integer $id
 * @property integer $patient_debt_id
 * @property string $payment_date
 * @property string $interest_amount
 * @property string $principal_amount
 * @property string $interest_paid
 * @property string $principal_paid
 * @property string $paid_date
 * @property string $notes
 *
 * @property PatientDebt $patientDebt
 */
class DebtPlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'debt_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_debt_id', 'payment_date'], 'required'],
            [['patient_debt_id'], 'integer'],
            [['payment_date', 'paid_date'], 'safe'],
            [['interest_amount', 'principal_amount', 'interest_paid', 'principal_paid'], 'number'],
            [['notes'], 'string', 'max' => 2000],
            [['patient_debt_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientDebt::className(), 'targetAttribute' => ['patient_debt_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'patient_debt_id' => Yii::t('app', 'Patient Debt ID'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'interest_amount' => Yii::t('app', 'Interest Amount'),
            'principal_amount' => Yii::t('app', 'Principal Amount'),
            'interest_paid' => Yii::t('app', 'Interest Paid'),
            'principal_paid' => Yii::t('app', 'Principal Paid'),
            'paid_date' => Yii::t('app', 'Paid Date'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientDebt()
    {
        return $this->hasOne(PatientDebt::className(), ['id' => 'patient_debt_id']);
    }
}
