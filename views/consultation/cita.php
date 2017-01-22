<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Consultation',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Consultations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->patient->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="consultation-update">

    <h2><?= Html::encode($model->patient->getFullName()). '   '.
        Html::a('<i class="glyphicon glyphicon-search"></i> '. Yii::t('app', 'Folder'), ['patient/view', 'id' => $model->patient_id], ['class' => 'btn btn-primary']) ?> </h2>
    <h3><?= Html::encode(date('d/m/Y',strtotime($model->consultation_date))) . ' - ' . $model->doctor->name  ?></h3>

    <?= $this->render('_cita', [
        'model' => $model,
        'patient'=>$model->patient
    ]) ?>

</div>
