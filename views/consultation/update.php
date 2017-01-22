<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Consultation',
]) . $model->patient->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Consultations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->patient->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Consultation');
?>
<div class="consultation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'patient'=>$model->patient
    ]) ?>

</div>
