<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::a('Регистрация', ['/user/reg'], ['class'=>'btn btn-primary']) ?>
            </div>
            <?= Html::a('Забыли пароль?', ['/user/send-email'], ['class'=>'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>



    <?php
        if (Yii::$app->getSession()->hasFlash('error')) {
            echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
        }
    ?>

    <p class="lead">Do you already have an account on one of these sites? Click the logo to log in with it here:</p>
    <?php echo \nodge\eauth\Widget::widget(['action' => 'site/login']); ?>

    
</div>
