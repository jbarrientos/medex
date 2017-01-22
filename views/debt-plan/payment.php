<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DebtPlan */

$this->title = Yii::t('app', 'Payment') . ' - '. $model->patientDebt->patient->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folder'), 'url' => ['patient/view','id'=>$model->patientDebt->patient_id]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Payment');

$debt = $model->patientDebt;
?>
<div class="debt-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $debt,
        'attributes' => [
            'id',
            'amount',
            [
                'attribute'=>'first_payment',
                'value'=>date('d/m/Y', strtotime($debt->first_payment))
            ],
            'num_months',
            [
                'label'=>Yii::t('app','Balance'),
                'value'=> number_format($debt->getBalance(),2)
            ],
            'notes',
            
        ],
    ]) ?>

    <?= $this->render('_payment', [
        'model' => $model,
    ]) ?>

</div>
