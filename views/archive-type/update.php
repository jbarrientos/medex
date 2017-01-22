<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArchiveType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Archive Type',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Archive Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="archive-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
