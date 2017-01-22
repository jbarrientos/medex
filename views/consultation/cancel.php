<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */

$this->title = Yii::t('app', 'Cancel Consultation', [
    'modelClass' => 'Consultation',
]) . ':'.$model->patient->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Consultations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->patient->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Consultation');
?>
<div class="consultation-update">

    <h2><?= Html::encode($this->title) ?></h2>
    <h3><?= 'Con Dr(a). ' . $model->doctor->name . ' El dia '.
            $model->consultation_date .' a las ' . $model->hour->name .' Horas.'?></h3>

    <?= $this->render('_cancel', [
        'model' => $model,
        'patient'=>$model->patient
    ]) ?>

</div>
