<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<section class="site-login row">


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
                <?= Html::button('Регистрация', ['class'=>'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modalReg', 'type' => 'button']) ?>

                <?= Html::button('Забыли пароль?', ['class'=>'btn btn-link', 'data-toggle' => 'modal', 'data-target' => '#modalReset', 'type' => 'button']) ?>
            </div>
           
        </div>

    <?php ActiveForm::end(); ?>



    <?php
        if (Yii::$app->getSession()->hasFlash('error')) {
            echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
        }
    ?>

    <p class="lead">Аторизация через социальные сети:</p>
    <?php echo \nodge\eauth\Widget::widget(['action' => 'site/login']); ?>

    
</section>

<div id="modalReg" class="modal fade site-login" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title">Регистрация пользователя</h1>
      </div>
      <div class="modal-body">
        <?php $form = ActiveForm::begin([
            'action' => ['user/reg'],
        ]); ?>

            <?= $form->field($reg, 'username') ?>
            <?= $form->field($reg, 'email') ?>
            <?= $form->field($reg, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
        <?php
        if($reg->scenario === 'emailActivation'):
        ?>
        <i>*На указанный емайл будет отправлено письмо для активации аккаунта.</i>
        <?php
        endif;
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalReset" class="modal fade site-login" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title">Сбросить пароль</h1>
      </div>
      <div class="modal-body">
        <div class="main-sendEmail">

            <?php $form = ActiveForm::begin([
                'action' => ['user/send-email'],
                'id' => 'resetBtn',
            ]); ?>

                <?= $form->field($reset, 'email') ?>
            
                <div class="form-group">
                    <?= Html::submitButton('Отправить', [ 'class' => 'btn btn-primary']) ?>
                </div>
                <?= Html::tag('div','', ['class' => "msg"]) ?>
            <?php ActiveForm::end(); ?>

        </div><!-- main-sendEmail -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>