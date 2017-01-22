<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */
/* @var $form yii\widgets\ActiveForm */


$doctors = ArrayHelper::map(app\models\Doctor::find([
    'organization_id'=>Yii::$app->session['medicalCenter']])->orderBy('name')->all(), 'id', 'name');

$hours = ArrayHelper::map(app\models\Hour::find()->orderBy('name')->all(), 'id', 'name');

?>

<div class="consultation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consultation_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Enter consultation date')],
            'value'=>getdate(),
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
                
            ]
        ]); ?>
    
    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'hour_id')->dropDownList($hours,
            ['prompt'=>Yii::t('app', 'Select Hour ...')]) ?>

    <?= $form->field($model, 'doctor_id')->dropDownList($doctors,
            ['prompt'=>Yii::t('app', 'Select Doctor ...')]) ?>

    <?= $form->field($model, 'notes')->textArea(['rows' => 4]) ?>
    
    <?= $form->field($model, 'patient_id')->hiddenInput(['value'=>$patient->id])->label(false) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
