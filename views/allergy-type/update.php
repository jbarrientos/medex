<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AllergyType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Allergy Type',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Allergy Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="allergy-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
