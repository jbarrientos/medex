<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Specialty;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */
/* @var $form yii\widgets\ActiveForm */

$specialties = ArrayHelper::map(Specialty::find()->orderBy('name')->all(), 'id','name');
?>

<div class="doctor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specialty_id')->dropDownList($specialties, 
    ['maxlength' => true, 'prompt'=>Yii::t('app', 'Select specialization...')]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'organization_id')->hiddenInput(['value'=>Yii::$app->session['medicalCenter']])->label(false) ?>
    
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>
        Yii::t('app', 'Email')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
