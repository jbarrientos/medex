<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PatientDiseaseNote */

$this->title = Yii::t('app', 'Create Patient Disease Note');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patient Disease Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-disease-note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
