<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CancelationType */

$this->title = Yii::t('app', 'Create Cancelation Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cancelation Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cancelation-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
