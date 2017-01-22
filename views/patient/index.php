<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patients');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h3><?= '<i class="glyphicon glyphicon-folder-close"></i> '.Html::encode($this->title).
        ' '.Yii::$app->session['centerName']?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-user"></i> '.Yii::t('app', 'Create Patient'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'first_name',
            'last_name',
            'document_id',
            ['attribute'=>'document_type_id','value'=>function($data){
                return $data->documentType->name;
            }],
            // 'birth_date',
            // 'weight',
            // 'height',
            // 'phone',
            // 'address',
            // 'email:email',
             'celullar',
            // 'organization_id',
            // 'picture',
            // 'content_type',
            // 'picture_size',
            // 'picture_name',
            // 'decease_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
