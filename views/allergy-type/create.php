<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AllergyType */

$this->title = Yii::t('app', 'Create Allergy Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Allergy Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="allergy-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
