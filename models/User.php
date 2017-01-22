<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $active
 * @property string $verification_code
 * @property string $password
 * @property integer $organization_id
 * @property string $user_type
 * @property integer $doctor_id
 *
 * @property Prescription[] $prescriptions
 * @property Organization $organization
 * @property Doctor $doctor
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'organization_id'], 'required'],
            [['organization_id'], 'integer'],
            [['doctor_id'],'safe'],
            [['username', 'email', 'verification_code', 'password'], 'string', 'max' => 100],
            [['active', 'user_type'], 'string', 'max' => 1],
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
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'active' => Yii::t('app', 'Active'),
            'verification_code' => Yii::t('app', 'Verification Code'),
            'password' => Yii::t('app', 'Password'),
            'organization_id' => Yii::t('app', 'Organization ID'),
            'user_type' => Yii::t('app', 'User Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptions()
    {
        return $this->hasMany(Prescription::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
    
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            if($insert){
                //$this->password = crypt($this->password);
                $this->verification_code = $this->genHexaHash(100); // crypt($this->email.$this->creation_date);                
                $this->active = 'N';
            }            
            return true;
        }else{
            return false;
        }
        
    }
    
    private function genHexRandom(){
        $val = '';
        for( $i=0; $i<100; $i++ ) {
           $val .= chr( rand( 65, 90 ) );
        }
        
        return $val;
    }
    
    function genHexaHash( $valLength ){
        $result = '';
        $moduleLength = 40;   // we use sha1, so module is 40 chars
        $steps = round($valLength/$moduleLength) + 0.5;

        for( $i=0; $i<$steps; $i++ ) {
          $result .= sha1(uniqid() . md5( rand() . uniqid() ) );
        }

        return substr( $result, 0, $valLength );
    }
    
    public function check($pass){
        if ($this->password == crypt($pass, $this->password)) {
            Yii::$app->session['medicalCenter'] = $this->organization_id;
            Yii::$app->session['role'] = $this->user_type;
            if($this->user_type == 'D'){
                Yii::$app->session['doctorId'] = $this->doctor_id;
            }
            
            Yii::$app->session['centerName'] = $this->organization->name;
            return true;
        } else {
            return false;
        }
    }
    
    public function validatePassword($pass){
        return $this->check($pass);
    }

    public function getAuthKey() {
        
        return $this->verification_code;
        
    }

    public function getId() {
        return $this->id;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getUsername(){
        return $this->email;
    }

    public function validateAuthKey($authKey) {
        return $this->verification_code == $authKey;
    }

    public static function findIdentity($id) {
         return static::findOne(['id'=>$id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }
    
    public static function findByEmail($email){
        return static::findOne(['email'=>$email]);
    }
    
    public static function findByUsername($email){
        return static::findOne(['email'=>$email]);
    }
    
    static function sendMail($from, $to, $subject, $body){
        Yii::$app->mailer->compose()
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setHtmlBody($body)
            ->send();
    }
    
    public function getTypeDescription(){
        return $this->user_type == 'A' ? 'ADMIN' :
                ($this->user_type == 'M' ? 'MANAGEMENT': ($this->user_type == 'D' ? 'Doctor' : 
                        ($this->user_type == 'S' ? 'SUPER' : 'Patient')));
    }
    
    public function isSuper(){
        return $this->user_type == 'S';
    }
    
    public function isAdmin(){
        return $this->user_type == 'A';
    }
    
    public function isAdministrative(){
        return $this->user_type == 'M';
    }
    
    public function isPatient(){
        return $this->user_type == 'P';
    }
    
    public function isDoctor(){
        return $this->user_type == 'D';
    }
    
    public function can($role){
        return $this->user_type == $role;
    }
}
