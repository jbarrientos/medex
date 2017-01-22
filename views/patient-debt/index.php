<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientDebtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patient Debts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-debt-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
              'attribute'=>'patient_id'  ,
                'value'=>function($data){
                    return $data->patient->getFullName();
                }
            ],
            //'patient_id',
            [
                'attribute'=>'debt_date',
                'value'=>function($data){
                    return date('d/m/Y',  strtotime($data->debt_date));
                }
            ],
            [
                'attribute'=>'amount',
                'value'=>function($data){
                    return number_format($data->amount,2);
                }
            ],
            [
                'header'=>Yii::t('app','Payment Amount'),
                'value'=>function($data){
                    return number_format($data->getPaymentAmount(),2);
                },'contentOptions'=>['style'=>'text-align:right']
            ],
            [
                'header'=>Yii::t('app','Payments'),
                'value'=>function($data){
                    return number_format($data->getPayments(),2);
                },'contentOptions'=>['style'=>'text-align:right']
            ],
            [
                'header'=>Yii::t('app','Balance'),
                'value'=>function($data){
                    return number_format($data->getBalance(),2);
                },'contentOptions'=>['style'=>'text-align:right']
            ],
//            [
//                'attribute'=>'first_payment',
//                'value'=>function($data){
//                    return date('d/m/Y',  strtotime($data->first_payment));
//                }
//            ],
            // 'notes',
            // 'num_months',
            // 'ints_rate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
