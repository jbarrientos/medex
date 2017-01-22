<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DebtPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debt-plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_debt_id')->textInput() ?>

    <?= $form->field($model, 'payment_date')->textInput() ?>

    <?= $form->field($model, 'interest_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interest_paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid_date')->textInput() ?>

    <?= $form->field($model, 'notes')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
