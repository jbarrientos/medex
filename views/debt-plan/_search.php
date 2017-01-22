<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DebtPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debt-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'patient_debt_id') ?>

    <?= $form->field($model, 'payment_date') ?>

    <?= $form->field($model, 'interest_amount') ?>

    <?= $form->field($model, 'principal_amount') ?>

    <?php // echo $form->field($model, 'interest_paid') ?>

    <?php // echo $form->field($model, 'principal_paid') ?>

    <?php // echo $form->field($model, 'paid_date') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
