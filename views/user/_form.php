<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Organization;

/* @var $this yii\web\View */
/* @var $model app\Models\User */
/* @var $form yii\widgets\ActiveForm */

$centros = ArrayHelper::map(Organization::find()->orderBy('name')->all(), 'id', 'name');
$doctors = ArrayHelper::map(app\models\Doctor::find()->orderBy('name')->all(), 'id', 'name');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organization_id')->dropDownList($centros, 
    ['maxlength' => true, 'prompt'=>Yii::t('app', 'Select Medical Center...')]) ?>

    <?= $form->field($model, 
            'user_type')->radioList(['A' => 'ADMIN','M'=>'ADMINISTRATIVE','D'=>'DOCTOR','P'=>'PATIENT']) ?>
    
    <?= $form->field($model, 'doctor_id')->dropDownList($doctors, 
    ['maxlength' => true, 'prompt'=>Yii::t('app', 'Select Doctor...')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
