<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'MEDEX');
?>
<div class="site-index">

    <div class="jumbotron specialjum">
        <div class="over container body-content">
            <h1><?php echo Yii::t('app', 'MEDEX')?></h1>
        
        <p class="lead"><?php echo Yii::t('app', 'Digital Folder for Medical Centers')?>.</p>

        <p><a class="btn btn-lg btn-primary" href="#"><?php echo Yii::t('app', 'More info')?></a></p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?php echo Yii::t('app', 'Complete Digital Folder')?></h2>

                <p><?php echo Yii::t('app', 
                        'Record a complete digital folder of your patients, store all the information necessary to have the data that the doctors or professionals that are attending them.') ?></p>

                <p><a class="btn btn-info" href="#"><?php echo Yii::t('app','More info')?></a></p>
            </div>
            <div class="col-lg-4">
                <h2><?php echo Yii::t('app', 'Medication Records')?></h2>

                <p><?php echo Yii::t('app', 'Medications are part of the treatment to heal a disease, and have a detailed record of the diferente medications and the frequency that has to be taken for the patiene, could make the diference.') ?></p>

                <p><a class="btn btn-info" href="#"><?php echo Yii::t('app','More info')?></a></p>
            </div>
            <div class="col-lg-4">
                <h2><?php echo Yii::t('app', 'Consultations Control')?></h2>

                <p><?php echo Yii::t('app','Take care of your patients thru periodic visits with the doctors, is a path to complete healing, give to the doctors a tool to have all the information that they need to give a better diagnosis and a beter medication of their patients.') ?></p>

                <p><a class="btn btn-info" href="#"><?php echo Yii::t('app','More info')?></a></p>
            </div>
        </div>

    </div>
</div>
