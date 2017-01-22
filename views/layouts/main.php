<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Medex',
        //. (isset(Yii::$app->session['centerName']) ? '- '.Yii::$app->session['centerName'] : ''),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'Folder'), 'url' => ['/patient/index'], 
                'visible'=>!Yii::$app->user->isGuest],
            ['label' => Yii::t('app', 'Consultations'), 'url' => ['/consultation/calendar'], 'visible'=>!Yii::$app->user->isGuest],
            ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index'], 
                'visible'=>!Yii::$app->user->isGuest && ( 
                        'S' == (isset(Yii::$app->session['role']) ? Yii::$app->session['role'] : '') ||
                        'A' == (isset(Yii::$app->session['role']) ? Yii::$app->session['role'] : '')
                    )],
            [
                'label'=>Yii::t('app', 'Queries'),
                'visible'=>!Yii::$app->user->isGuest,
                'url'=>['#'],
                'items'=>[
                    ['label'=>Yii::t('app', 'Patient Debts'),'url'=>['patient-debt/index']]
                ]
            ],
            ['label' => Yii::t('app', 'Parameters'), 
                'visible'=>!Yii::$app->user->isGuest && ( 
                        'S' == (isset(Yii::$app->session['role']) ? Yii::$app->session['role'] : '') ||
                        'A' == (isset(Yii::$app->session['role']) ? Yii::$app->session['role'] : '')
                    ),
                'url' => ['#'],
                'items'=>[
                    [ 'label'=>Yii::t('app', 'Allergy Types'),'url'=>['/allergy-type/index']],
                    [ 'label'=>Yii::t('app', 'Diseases'),'url'=>['/disease/index']],
                    [ 'label'=>Yii::t('app', 'Document Types'),
                        'visible'=>!Yii::$app->user->isGuest &&
                        'S' == (isset(Yii::$app->session['role']) ? Yii::$app->session['role'] : ''),
                        'url'=>['/document-type/index']],
                    [ 'label'=>Yii::t('app', 'Medical Centers'),
                        'visible'=>!Yii::$app->user->isGuest &&
                        'S' == (isset(Yii::$app->session['role']) ? Yii::$app->session['role'] : ''),
                        'url'=>['/organization/index']],
                    [ 'label'=>Yii::t('app', 'Specialties'),'url'=>['/specialty/index']],
                    [ 'label'=>Yii::t('app', 'Doctors'),'url'=>['/doctor/index']],
                    [ 'label'=>Yii::t('app', 'Cancelation Types'),'url'=>['/cancelation-type/index']],
                    [ 'label'=>Yii::t('app', 'Archive Types'),'url'=>['/archive-type/index']],
                    
                ]],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container"> 
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Medex <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
