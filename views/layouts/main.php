<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$logo = '<img src="/pictures/logo.jpg" alt="logo" class="logo" />';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">

    <?php
    NavBar::begin([
        'brandLabel' => "МЕДПЛЮС",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
      ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav align-items-center d-flex'],
        'items' => [
            ['label' => $logo, 'url' => ['/site/index'], 'encode' => false],
            ['label' => 'Домой', 'url' => ['/site/index']],
            ['label' => 'Запись на приём', 'url' => ['/reception']],
            Yii::$app->user->isGuest
                ? ['label' => 'Вход', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->fio . ')',
                        ['class' => 'nav-link btn btn-link logout']
                        
                        )
                    . Html::endForm()
                    . '</li>',
            Yii::$app->user->isGuest ? ['label'=> 'Регистрация','url'=> ['/site/register']] : '',
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['homeLink' => ['label' => 'ДОМОЙ', 'url' => '/'], 'links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-md-start">&copy; Medplus
                <p class="mb-0">+7 (999) 888 33-22</p>
                <p> med-plus@mail.ru</p>
           
                <?= date('Y') ?>
            </div>

            <div class="col-md-6 text-md-end d-flex flex-column">
               <a href="/site/index" class="nav-link px-2 link-dark">ДОМОЙ</a> 
               <a href="/site/contact" class="nav-link px-2 link-dark">ЗАПИСЬ НА ПРИЁМ</a> 
               <a href="/site/login" class="nav-link px-2 link-dark">ВХОД</a> 
               <a href="/site/register" class="nav-link px-2 link-dark">РЕГИСТРАЦИЯ</a> 
            </div>

        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
