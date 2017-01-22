<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */

$this->title = $model->patient->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Consultations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultation-view">

    <h1><?= Html::encode($this->title) . ' - '. $model->getStatus().'  '.
        Html::a(Yii::t('app', 'Folder'), ['patient/view', 'id' => $model->patient_id], ['class' => 'btn btn-success']) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute'=>'patient_id',
                'value'=>$model->patient->getFullName()
            ],
            [
                'attribute'=>'consultation_date',
                'value'=>date('d/m/Y',strtotime($model->consultation_date)).'@'.$model->hour->name
            ],
            [
                'attribute'=>'doctor_id',
                'value'=>$model->doctor->name
            ],
            'diagnosis',
            'recomendation',
            'notes',
            'prescription',
            'weight',
            //'patient_id',
            //'disease_id',
            'next_consultation',
            [
                'attribute'=>'next_doctor_id',
                'value'=>isset($model->next_doctor_id) ? $model->doctor->name : ''
            ],
            //'next_doctor_id',
        ],
    ]) ?>
    
    <p>
        
        <?php 
        // Usuarios Administrativos pueden modificar fechas y cancelar citas
        if(Yii::$app->session['role'] == 'M'):
        ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        <?= Html::a(Yii::t('app', 'Cancel Consultation'), 
            ['cancel', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?php elseif(Yii::$app->session['role'] == 'D' && $model->doctor_id == Yii::$app->session['doctorId']): ?>
        <?= Html::a(Yii::t('app', 'Proceed'), ['cita', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif;?>
        
        
        
        
    </p>

</div>
