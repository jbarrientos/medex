<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */
/* @var $form yii\widgets\ActiveForm */

//$diseases = ArrayHelper::map(app\models\Disease::find()->orderBy('name')->all(), 'id', 'name');


$doctors = ArrayHelper::map(app\models\Doctor::find([
    'organization_id'=>Yii::$app->session['medicalCenter']])->orderBy('name')->all(), 'id', 'name');


?>

<div class="consultation-form">

    <?php $form = ActiveForm::begin(); ?>

    
    
    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'diagnosis')->textArea(['rows' => 4]) ?>
    <?= $form->field($model, 'recomendation')->textArea(['rows' => 4]) ?>
    
    <?= $form->field($model, 'notes')->textArea(['rows' => 4]) ?>
    
    <?= $form->field($model, 'prescription')->textArea(['rows' => 6]) ?>
    
    
    <?= $form->field($model, 'patient_id')->hiddenInput(['value'=>$patient->id])->label(false) ?>
    
    <?= $form->field($model, 'next_consultation')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Enter consultation date')],
            'value'=>getdate(),
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
                
            ]
        ]); ?>
    
    <?= $form->field($model, 'next_doctor_id')->dropDownList($doctors,
            ['prompt'=>Yii::t('app', 'Select Doctor ...')]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['patient/view', 'id' => $patient->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
