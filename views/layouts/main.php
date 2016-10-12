<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\Lang;


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

    $lang = new Lang();
    $cookies = Yii::$app->request->cookies;
    $language = $cookies->getValue('language', 'eng');

    $lanID = $lang->getIndex($language) ? $lang->getIndex($language) : 0; 
    //$lanID = 0;

    NavBar::begin([
        'brandLabel' => 'Бугагагагашки',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo '
        <form class="navbar-form navbar-right" action="/poem/web/index.php?r=search%2Fpublic" method="post">
            <input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'" />
            <input type="search" class="form-control" placeholder="'.$lang->search[$lanID].'...'.'" name="public_search" maxlength="50">
            <button type="submit" class="btn btn-black">
                 <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
        </form>
    ';

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => $lang->home[$lanID], 'url' => ['/site/index']],
            ['label' => $lang->poems[$lanID], 'url' => ['/art/poems']],
            ['label' => $lang->anecdote[$lanID], 'url' => ['/art/anekdots']],
            ['label' => $lang->haiku[$lanID], 'url' => ['/art/hokkys']],
            [
                'label' => $lang->about[$lanID], 'items' => [
                    ['label' => $lang->about[$lanID], 'url' => ['/site/about']],
                    ['label' => $lang->connect[$lanID], 'url' => ['/site/contact']],
                ]
            ],
            [
                'label' => $lang->add[$lanID], 'items' => [
                    ['label' => $lang->addpoem[$lanID], 'url' => ['/moderator/addpoem']],
                    ['label' => $lang->addanec[$lanID], 'url' => ['/moderator/addanekdot']],
                    ['label' => $lang->addhaiku[$lanID], 'url' => ['/moderator/addhokky']],
                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => $lang->login[$lanID], 'url' => ['/site/login'],
                    'template' => '<a href="{url}" >{label}<button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button></a>'                                    
                ]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    $lang->logout[$lanID] .' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
   
    

    NavBar::end();

    /*
    Html::beginForm(['order/update', 'class' => 'form-inline'], 'post');
        Html::input('text', 'username', 'DA', ['class' => 'form-control']);
    Html::endForm();
    */
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => 'Главная',
                'url' => Yii::$app->getHomeUrl()
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<div class="lang">
    <?= Html::a('Rus', Url::to(['site/lang', 'id' => 'ru']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Eng', Url::to(['site/lang', 'id' => 'eng']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Bib', Url::to(['site/lang', 'id' => 'bib']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
</div>
<div class="lang1">
    <?= Html::a('Ukr', Url::to(['site/lang', 'id' => 'ukr']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Imp', Url::to(['site/lang', 'id' => 'imp']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Ar', Url::to(['site/lang', 'id' => 'ar']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
</div>
<div class="lang2">
    <?= Html::a('De', Url::to(['site/lang', 'id' => 'de']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Fr', Url::to(['site/lang', 'id' => 'fr']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Bas', Url::to(['site/lang', 'id' => 'bas']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
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
