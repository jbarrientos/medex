<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsultationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Consultations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultation-index">

    <h3><?= '<i class="glyphicon glyphicon-calendar"></i> '.Yii::t('app','Consultations')
    .' '.Yii::$app->session['centerName']?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Consultation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'consultation_date',
                'value'=>function($data){
                    return date('d/m/Y',  strtotime($data->consultation_date));
                }
            ],
            [
                'attribute'=>'doctor_id',
                'value'=>function($data){
                    return $data->doctor->name;
                }
            ],
            [
                'attribute'=>'patient_id',
                'value'=>function($data){
                    return $data->patient->getFullName();
                }
            ],
                    
            //'diagnosis',
            //'recomendation',
            'notes',
            // 'patient_id',
            // 'disease_id',
            'next_consultation',
            //'next_doctor_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
