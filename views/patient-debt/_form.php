<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\PatientDebt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-debt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_id')->hiddenInput(['value'=>$patient->id])->label(false) ?>
    
    <?= $form->field($model, 'first_payment')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Enter first payment date ...')
                ,'style'=>'width:30%'],
            'value'=>getdate(),
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
                
            ]
        ]); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'style'=>'width:35%', 
        'placeholder'=>Yii::t('app','Enter Total Amount')]) ?>
    <?= $form->field($model, 'ints_rate')->textInput(['maxlength' => true,'style'=>'width:35%', 
        'placeholder'=>Yii::t('app','Enter Interest %')]) ?>

    <?= $form->field($model, 'num_months')->textInput(['type'=>'number','style'=>'width:20%',
        'placeholder'=>Yii::t('app', 'Number of Months')]) ?>

    <?= $form->field($model, 'notes')->textArea(['rows' => 6,
        'placeholder'=>Yii::t('app', 'Annotations')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
