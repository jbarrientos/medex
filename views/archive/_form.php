<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

use yii\helpers\ArrayHelper;

$tipos = ArrayHelper::map(app\models\ArchiveType::find()->orderBy('name')->all(), 'id', 'name');

/* @var $this yii\web\View */
/* @var $model app\models\Archive */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="archive-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'patient_id')->hiddenInput(['value'=>$patient->id])->label(false) ?>

    <?= $form->field($model, 'archive_type_id')->dropDownList($tipos,
            ['prompt'=>Yii::t('app', 'Select archive type...')]) ?>
    
    <?= $form->field($model, 'archive_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Enter archive date ...')],
            'value'=>getdate(),
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
                
            ]
        ]); ?>
    
    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'responsible')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textArea(['rows' => 4]) ?>

    <?= $form->field($model, 'uploadedFile')->fileInput(['class'=>'btn btn-info btn-lg'])->hint(
                Yii::t('app','You can drap the file to upload it.')) ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
