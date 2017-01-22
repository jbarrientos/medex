<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmergencyContact */

$this->title = Yii::t('app', 'Create Emergency Contact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emergency Contacts'), 
    'url' => ['patient/view','id'=>$patient->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emergency-contact-create">

    <h1><?= Html::encode($this->title)?></h1>
    <h3><?= Yii::t('app', 'Patient ID') . ': ' . $patient->getFullName() ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'patient'=>$patient
    ]) ?>

</div>
