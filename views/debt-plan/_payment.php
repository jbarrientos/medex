<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DebtPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debt-plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'principal_paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textArea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
