<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\PatientDebt */

$this->title = Yii::t('app', 'Patient Debt') . ": ".$model->patient->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folder'), 'url' => ['patient/view','id'=>$model->patient->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-debt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'patient_id',
            //'debt_date',
            'amount',
            [
                'attribute'=>'first_payment',
                'value'=>date('d/m/Y', strtotime($model->first_payment))
            ],
            'num_months',
            //'ints_rate',            
            [
                'label'=>Yii::t('app','Balance'),
                'value'=> number_format($model->getBalance(),2)
            ],
            
            //'first_payment',
            'notes',
            
        ],
    ]) ?>
    <h2><?= Yii::t('app','Patient Debt') ?></h2>
    <?= 
        GridView::widget([
            'dataProvider' => $plan,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute'=>'payment_date',
                    'value'=>function($data){
                        return date('d/m/Y', strtotime($data->payment_date));
                    }
                ],
                [
                 'attribute'=>'principal_amount',
                    'value'=>function($data){
                        return number_format($data->principal_amount,2);
                    }, 'contentOptions'=>['style'=>'text-align:right']
                ],
                [
                    'attribute'=>'paid_date',
                    'value'=>function($data){
                        return ($data->principal_paid > 0.00 ? date('d/m/Y', strtotime($data->paid_date)) : '');
                    }
                ],
                [
                 'attribute'=>'principal_paid',
                    'value'=>function($data){
                        return number_format($data->principal_paid,2);
                    },
                    'contentOptions'=>['style'=>'text-align:right']
                ],
                            'notes',
                
                [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                'buttons'=>[
                    'view'=>function($url, $model, $key){
                        return Html::a('<i class="glyphicon glyphicon-calendar"></i> ',
                        ['debt-plan/payment','id'=>$model->id],
                                ['class'=>'btn btn-info']);
                    },
                ]
                ]

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ])
        ?>

</div>
