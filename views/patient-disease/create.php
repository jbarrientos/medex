<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PatientDisease */

$this->title = Yii::t('app', 'Create Patient Disease');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patient Diseases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-disease-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
