<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PatientDebt */

$this->title = Yii::t('app', 'Create Patient Debt') . ': '.$patient->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patient Debts'), 'url' => ['patient/view','id'=>$patient->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-debt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'patient'=>$patient
    ]) ?>

</div>
