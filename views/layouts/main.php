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
    

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => $lang->home[$lanID], 'url' => ['/site/index']],
            [
                'label' => 'Категории', 'items' => [
                    ['label' => $lang->poems[$lanID], 'url' => ['/art/poems']],
                    ['label' => $lang->anecdote[$lanID], 'url' => ['/art/anekdots']],
                    ['label' => $lang->haiku[$lanID], 'url' => ['/art/hokkys']],
                ]
            ],
            [
                'label' => $lang->about[$lanID], 'items' => [
                    ['label' => $lang->about[$lanID], 'url' => ['/site/about']],
                    ['label' => $lang->connect[$lanID], 'url' => ['/site/contact']],
                ]
            ],
            isset(Yii::$app->user->getIdentity()['role']) ? (
            [
                'label' => $lang->add[$lanID], 'items' => [
                    ['label' => $lang->addpoem[$lanID], 'url' => ['/moderator/addpoem']],
                    ['label' => $lang->addanec[$lanID], 'url' => ['/moderator/addanekdot']],
                    ['label' => $lang->addhaiku[$lanID], 'url' => ['/moderator/addhokky']],
                ],
            ]) : (
                ['label' => 'Профиль', 'url' => ['/user/profile']]
            ),            

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
            ),
'<li>'.'
    <form class="navbar-form  search-bar-form " action="/poem/web/index.php?r=search%2Fpublic" method="post">
        <div class="form-group">
            <input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'" />
            <div class="search-bar-panel">
            <div class="input-group">
              <input type="search" class="form-control search-input" placeholder="'.$lang->search[$lanID].'...'.'" name="public_search" maxlength="50">
            </div>
            <button type="submit" class="btn btn-black">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
            </div>
        </div>    
    </form>'.
'</li>'
        ],
    ]);
   
    

    NavBar::end();


    /*
    Html::beginForm(['order/update', 'class' => 'form-inline'], 'post');
        Html::input('text', 'username', 'DA', ['class' => 'form-control']);
    Html::endForm();
    */
    echo Yii::$app->user->id;

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




<footer class="footer">
    <div class="container">        
        <div class="row">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>       
        </div>

        <div class="row">
            <div class="lang-row">
            <?php
            $items = [
                'ru' => "Русский",
                'eng' => "English", 
                'bib' => "Limba lui Biboran",
                'ukr' => 'Українська',
                'imp' => 'Дореволюционный',
                'ar' => 'Arab',
                'de' => 'German',
                'fr' => 'French',
                'bas' => 'Башкирский'
            ];

            echo Html::beginForm(['site/lang', 'id' => 'form'], 'get', ['class' => 'lang-form']);
            echo Html::tag('div',        
                    Html::tag('div', Html::dropDownList('id', null, $items, []), ['class' => 'styled-select black rounded lang']).
                    Html::submitButton('Выбрать', ['class' => 'btn btn-default lang']),
                ['class' => 'form-group']);        
            echo Html::endForm();
            ?> 
                   
            </div>
            <div class="copy">Сopyright © 2016 Все права защищены
                Права на все материалы, представленные здесь, принадлежат их авторам
                Ваши вопросы и предложения можете направлять на 
                <a href="mailto:zlapot@yandex.ru">zlapot@yandex.ru</a>
            </div>

        </div>
    </div>

           

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
