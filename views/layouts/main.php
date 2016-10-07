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
        'brandLabel' => 'Бугагагагашки',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Стихи', 'url' => ['/art/poems']],
            ['label' => 'Анекдоты', 'url' => ['/art/anekdots']],
            ['label' => 'Хокку', 'url' => ['/art/hokkys']],
            [
                'label' => 'О нас', 'items' => [
                    ['label' => 'О нас', 'url' => ['/site/about']],
                    ['label' => 'Связь', 'url' => ['/site/contact']],
                ]
            ],
            [
                'label' => 'Добавить', 'items' => [
                    ['label' => 'Стих', 'url' => ['/moderator/addpoem']],
                    ['label' => 'Анекдот', 'url' => ['/moderator/addanekdot']],
                    ['label' => 'Хокку', 'url' => ['/moderator/addhokky']],
                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login'],
                    'template' => '<a href="{url}" >{label}<button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button></a>'                                    
                ]
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
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
