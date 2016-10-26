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

$session = Yii::$app->session;

if ($session->isActive){
    if(isset($_SESSION['css'])){
        $cssFile = $_SESSION['css'];
    }else{
        $cookies = Yii::$app->request->cookies;
        $cssFile = $cookies->getValue('css', 'css/commonflat.css');
        $session['css'] = $cssFile;
    }
}else{
    $session->open();
    $cookies = Yii::$app->request->cookies;
    $cssFile = $cookies->getValue('css', 'css/commonflat.css');
    $session['css'] = $cssFile;
}

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
    <?= Html::cssFile(Url::home().$cssFile) ?>
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
            ['label' => \Yii::t('common', 'Главная'), 'url' => ['/site/index']],
            [
                'label' => \Yii::t('common', 'Категории'), 'items' => [
                    ['label' => \Yii::t('common', 'Стихи'), 'url' => ['/art/poems']],
                    ['label' => \Yii::t('common', 'Анекдоты'), 'url' => ['/art/anekdots']],
                    ['label' => \Yii::t('common', 'Хокку'), 'url' => ['/art/hokkys']],
                ]
            ],
            
            (!Yii::$app->user->isGuest) ? (
                [
                    'label' => \Yii::t('common', 'Добавить'), 'items' => [
                        ['label' => \Yii::t('common', 'Стих'), 'url' => ['/moderator/addpoem']],
                        ['label' => \Yii::t('common', 'Анекдот'), 'url' => ['/moderator/addanekdot']],
                        ['label' => \Yii::t('common', 'Хокку'), 'url' => ['/moderator/addhokky']],
                    ],                
                ]
            ) : (
                [
                    'label' => \Yii::t('common', 'О нас'), 'items' => [
                        ['label' => \Yii::t('common', 'О нас'), 'url' => ['/site/about']],
                        ['label' => \Yii::t('common', 'Связь'), 'url' => ['/site/contact']],
                    ],
                ]
            ),            
            
            ['label' => \Yii::t('common', 'Профиль'), 'url' => ['/user/profile']],
            
            Yii::$app->user->isGuest ? (
                ['label' => \Yii::t('common', 'Войти'), 'url' => ['/site/login'],
                    'template' => '<a href="{url}" >{label}<button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button></a>'                                    
                ]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    \Yii::t('common', 'Выйти') .' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            ),
'<li>'.'
    <form class="navbar-form  search-bar-form " action="'.Url::home().'search/public" method="post">
        <div class="form-group">
            <input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'" />
            <div class="search-bar-panel">
            <div class="input-group">
              <input type="search" class="form-control search-input" placeholder="'.\Yii::t('common', 'Поиск...').'" name="public_search" maxlength="50">
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


    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => Yii::t('common', 'Главная'),
                'url' => Yii::$app->getHomeUrl()
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>


<?= Html::tag('div', 
        Html::a('', Url::to(['site/change-css', 'id' => 'commonflat']), ['class'=>'flat', 'data-css' => Url::home().'css/commonflat.css']).
        Html::a('', Url::to(['site/change-css', 'id' => 'common']), ['class'=>'red', 'data-css' => Url::home().'css/common.css']),
    ['id' => 'cssCheched'])
?>


<footer class="footer">
    <div class="container">        
        <div class="row">
            <p class="pull-left">&copy; Bugagashki <?= date('Y') ?></p>

            <div class="pull-right">
                 <div class="copyZ"> <?= \Yii::t('common/copy', 'Все права защищены. Права на все материалы, представленные здесь, принадлежат их авторам. Ваши вопросы и предложения можете направлять на') ?>
                <a href="mailto:zlapot@yandex.ru">zlapot@yandex.ru</a>
            </div>
            </p>       
        </div>

        <div class="row">
            <div class="lang-row">
            <?php
            $items = [
                'ru' => "Русский",
                'eng' => "English", 
                'bib' => "Română",
                'ukr' => 'Українська',
                'imp' => 'Дореволюционный',                
                'de' => 'German',
                'fr' => 'French',                
            ];

            echo Html::beginForm(['site/lang', 'id' => 'form'], 'get', ['class' => 'lang-form']);
            echo Html::tag('div',        
                    Html::tag('div', Html::dropDownList('id', null, $items, []), ['class' => 'styled-select black rounded lang']).
                    Html::submitButton(Yii::t('common/main', 'Выбрать'), ['class' => 'btn btn-default lang']),
                ['class' => 'form-group']);        
            echo Html::endForm();
            ?> 
                   
            </div>
           

        </div>
    </div>

           

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
