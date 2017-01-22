<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */
/* @var $form yii\widgets\ActiveForm */


$cancels = ArrayHelper::map(app\models\CancelationType::find()->orderBy('name')->all(), 'id', 'name');

?>

<div class="consultation-form">

    <?php $form = ActiveForm::begin(); ?>

    
    
    <?= $form->field($model, 'cancelation_type_id')->dropDownList($cancels,
            ['prompt'=>Yii::t('app', 'Select Cancelation Type ...')]) ?>
    <?= $form->field($model, 'cancelation_notes')->textArea(['rows' => 6]) ?>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Cancel Consultation'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Return'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
