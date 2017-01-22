<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArchiveType */

$this->title = Yii::t('app', 'Create Archive Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Archive Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archive-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
