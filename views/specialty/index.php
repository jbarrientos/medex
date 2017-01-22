<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpecialtySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Specialties');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialty-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Specialty'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'name',
                'value'=>function($data){
                return $data->name;
            },'contentOptions'=>['style'=>'width:20%;']],
                    ['attribute'=>'details',
                'value'=>function($data){
                return $data->details;
            },'contentOptions'=>['style'=>'width:70%;']],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
