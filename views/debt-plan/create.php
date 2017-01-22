<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DebtPlan */

$this->title = Yii::t('app', 'Create Debt Plan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Debt Plans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debt-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
