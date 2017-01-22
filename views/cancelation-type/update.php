<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CancelationType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cancelation Type',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cancelation Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cancelation-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
