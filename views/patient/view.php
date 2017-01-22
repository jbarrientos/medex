<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\detail\DetailView;
//use kartik\grid\GridView;
//use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="patient-view">

    <h2><?= '<i class="glyphicon glyphicon-folder-close"></i> '. Yii::t('app', 'Folder') . ' ' . $this->title ?></h2>
    
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-user"></i> '.Yii::t('app', 'Patients'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-calendar"></i> '.Yii::t('app', 'Create Consultation'), ['consultation/create', 'patientId'=>$model->id],                 
    ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-envelope"></i> '.Yii::t('app', 'Create Emergency Contact'), ['emergency-contact/create', 'patientId'=>$model->id],                 
    ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-upload"></i> '.Yii::t('app', 'Upload Archive'), 
    ['archive/create', 'patientId'=>$model->id], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<i class="glyphicon glyphicon-book"></i> '.Yii::t('app', 'Create Debt'), 
    ['patient-debt/create', 'patientId'=>$model->id], ['class' => 'btn btn-danger']) ?>
        
        
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> '.Yii::t('app', 'Update'), 
    ['update', 'id'=>$model->id],                 
    ['class' => 'btn btn-default']) ?>
        
        
    </p>
    
   <?php 
              
            $tabs = [
                [
                    'label'=>Yii::t('app', 'General Info'),
                    'content'=>DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'label'=>Yii::t('app', 'Name'),
                                'value'=>$model->getFullName()
                            ],
                            //'first_name','last_name',
                            [
                                'attribute'=>'birth_date',
                                'value'=>date('d/m/Y',strtotime($model->birth_date))
                            ],
                            [
                                'attribute'=>'document_id',
                                'value'=>$model->document_id . ' ('.$model->documentType->name.')'
                            ],'allergies',
                            'weight','height','phone','address','email','celullar'
                        ],
                    ])
                 ],
                [
                    'label'=>Yii::t('app', 'Consultations'),
                    'content'=>GridView::widget([
                            'dataProvider' => $consultations,
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],
                                
                                [
                                    'attribute'=>'consultation_date',
                                    'value'=>function($data){
                                        return date('d/m/Y', strtotime($data->consultation_date));
                                    }
                                ],
                                [
                                 'attribute'=>'hour_id',
                                    'value'=>function($data){
                                        return $data->hour->name;
                                    }
                                ],
                                [
                                 'attribute'=>'doctor_id',
                                    'value'=>function($data){
                                        return $data->doctor->name;
                                    }
                                ],
                                [
                                 'attribute'=>'status',
                                    'value'=>function($data){
                                        return $data->getStatus();
                                    }
                                ],
                                'diagnosis',
                                [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{view}',
                                'buttons'=>[
                                    'view'=>function($url, $model, $key){
                                        return Html::a('<i class="glyphicon glyphicon-search"></i> ',['consultation/view','id'=>$model->id],
                                                ['class'=>'btn btn-info']);
                                    },
                                ]
                                ]
                                        
                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ])
                ],
                                            
                [
                    'label'=>Yii::t('app', 'Emergency Contacts'),
                    'content'=>GridView::widget([
                            'dataProvider' => $contacts,
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],
                                
                                'contact_name',
                                [
                                 'attribute'=>'relationship_id',
                                    'value'=>function($data){
                                        return $data->relationship->name;
                                    }
                                ],
                                'email','phone',
                                // 'next_doctor_id',

                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ])
                ],
                [
                    'label'=>Yii::t('app', 'Picture'),
                    'content'=>
                    (isset($model->picture_name)?
                      "<img width='250' height='300' class='img-rounded foto' src='".Yii::$app->urlManager->createUrl(['patient/picture','id'=>$model->id]). "' />" : "<br />"),
                ],
                [
                    'label'=>Yii::t('app', 'Archive'),
                    'content'=>GridView::widget([
                            'dataProvider' => $archives,
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],
                                
                                [
                                    'attribute'=>'archive_date',
                                    'value'=>function($data){
                                        return date('d/m/Y', strtotime($data->uploaded_date));
                                    }
                                ],
                                'uploaded_date',
                                [
                                 'attribute'=>'archive_type_id',
                                    'value'=>function($data){
                                        return $data->archiveType->name;
                                    }
                                ],
                                [
                                 'attribute'=>'user_id',
                                    'value'=>function($data){
                                        return $data->user->username;
                                    }
                                ],
                                'place',//'contact_phone',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template'=>'{view}',
                                    'buttons'=>[
                                        'view'=>function($url, $model, $key){
                                            return Html::a('<i class="glyphicon glyphicon-download-alt"></i> ',
                                            ['archive/download','id'=>$model->id],
                                                    ['class'=>'btn btn-info']);
                                        },
                                    ]
                                ]
                                // 'next_doctor_id',

                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ])
                ],
                                                [
                    'label'=>Yii::t('app', 'Patient Debts'),
                    'content'=>GridView::widget([
                            'dataProvider' => $debts,
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],
                                
                                [
                                    'attribute'=>'debt_date',
                                    'value'=>function($data){
                                        return date('d/m/Y', strtotime($data->debt_date));
                                    }
                                ],
                                
//                                [
//                                 'attribute'=>'ints_rate',
//                                    'value'=>function($data){
//                                        return number_format($data->ints_rate,2);
//                                    },
//                                    'contentOptions'=>['style'=>'text-align:right']
//                                ],
                                [
                                    'attribute'=>'first_payment',
                                    'value'=>function($data){
                                        return date('d/m/Y', strtotime($data->first_payment));
                                    }
                                ],
                                [
                                    'attribute'=>'num_months',
                                    'value'=>function($data){
                                        return $data->num_months;
                                    },'contentOptions'=>['style'=>'text-align:right']
                                ],
                                [
                                 'attribute'=>'amount',
                                    'value'=>function($data){
                                        return number_format($data->amount,2);
                                    }, 'contentOptions'=>['style'=>'text-align:right']
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
                                [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{view}',
                                'buttons'=>[
                                    'view'=>function($url, $model, $key){
                                        return Html::a('<i class="glyphicon glyphicon-search"></i> ',
                                        ['patient-debt/view','id'=>$model->id],
                                                ['class'=>'btn btn-info']);
                                    },
                                ]
                                ]
                                        
                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ])
                ],
              ];
            
            echo \yii\bootstrap\Tabs::widget(
                    [
                        'items'=>$tabs,
                    ]
                    );
            
            ?>
     

</div>
