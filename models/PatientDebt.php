<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_debt".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property string $debt_date
 * @property string $amount
 * @property string $first_payment
 * @property string $notes
 * @property integer $num_months
 * @property string $ints_rate
 * @property integer $user_id
 * @property integer $organization_id
 *
 * @property DebtPlan[] $debtPlans
 * @property Patient $patient
 * @property User $user
 * @property Organization $organization
 */
class PatientDebt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_debt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'debt_date', 'first_payment','amount','num_months'], 'required'],
            [['patient_id', 'num_months'], 'integer'],
            [['debt_date', 'first_payment'], 'safe'],
            [['organization_id'],'safe'],
            [['amount', 'ints_rate'], 'number'],
            [['notes'], 'string', 'max' => 2000],
            [['user_id'],'safe'],
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
            'debt_date' => Yii::t('app', 'Debt Date'),
            'amount' => Yii::t('app', 'Amount'),
            'first_payment' => Yii::t('app', 'First Payment'),
            'notes' => Yii::t('app', 'Notes'),
            'num_months' => Yii::t('app', 'Num Months'),
            'ints_rate' => Yii::t('app', 'Ints Rate'),
            'user_id' => Yii::t('app', 'User'),
            'organization_id'=> Yii::t('app', 'Medical Center'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebtPlans()
    {
        return $this->hasMany(DebtPlan::className(), ['patient_debt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }
    
    public function getBalance(){
        
        $query = (new \yii\db\Query())->from('debt_plan')->where(['patient_debt_id'=>$this->id]);
        
        return $query->sum('(principal_amount - principal_paid)');
    }
    
    public function getPaymentAmount(){
        return round($this->amount / $this->num_months,2);
    }
    
    public function getPayments(){
        
        $query = (new \yii\db\Query())->from('debt_plan')->where(['patient_debt_id'=>$this->id]);
        
        return $query->sum('(principal_paid)');
    }
            
}
