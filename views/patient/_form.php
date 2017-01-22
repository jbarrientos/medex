<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;

$tiposDocumento = ArrayHelper::map(app\models\DocumentType::find()->orderBy('name')->all(), 'id', 'name');
$bloodTypes = ArrayHelper::map(app\models\BloodType::find()->orderBy('name')->all(), 'id','name');

/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'blood_type_id')->dropDownList($bloodTypes,
            ['prompt'=>Yii::t('app', 'Select blood type...')]) ?>
    
    <?= $form->field($model, 'document_type_id')->dropDownList($tiposDocumento,
            ['prompt'=>Yii::t('app', 'Select document type...')]) ?>

    <?= $form->field($model, 'document_id')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Enter birth date ...')],
            'value'=>getdate(),
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
                
            ]
        ]); ?>
    
    <?= $form->field($model, 
            'gender')->radioList(['F' => Yii::t('app', 'Female'),'M'=>Yii::t('app', 'Male')]) ?>
    
    <?= $form->field($model, 'allergies')->textArea(['rows' => 4]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textArea(['rows' => 3]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celullar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uploadedFile')->fileInput(['class'=>'btn btn-info btn-lg'])->hint(
                Yii::t('app','You can drap the picture file to upload it.')) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), 
            ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
