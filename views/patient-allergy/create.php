<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PatientAllergy */

$this->title = Yii::t('app', 'Create Patient Allergy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patient Allergies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-allergy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
