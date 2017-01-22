<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientDebtSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-debt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'debt_date') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'first_payment') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'num_months') ?>

    <?php // echo $form->field($model, 'ints_rate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
