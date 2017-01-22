<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\EmergencyContact */
/* @var $form yii\widgets\ActiveForm */

$parentescos = ArrayHelper::map(app\models\Relationship::find()->orderBy('name')->all(), 'id', 'name');
?>

<div class="emergency-contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_id')->hiddenInput(['value'=>$patient->id])->label(false) ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'relationship_id')->dropDownList($parentescos,
            ['prompt'=>Yii::t('app', 'Select Relationship ...')]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textArea(['rows' => 4]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
