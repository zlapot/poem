<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('common/title', 'Добавление анекдота');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Анекдоты'), 'url' => ['art/anekdots']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="row main-page-content">
    <section class="col-md-8 add-form circle-border">

    <?php $form = ActiveForm::begin([
    'id' => 'post-form',
    'options' => ['class' => 'form-horizontal'],
    //'enableAjaxValidation'=>true,
    ]); ?>
                    
        <?= $form->field($model, 'anekdot', [
            'template' => '{label} <div class="col-sm-10">{input}{error}{hint}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ]
        ])->textarea(['rows' => 20, 'cols' => 5]) ?>

        <?= $form->field($model, 'autor', [
            'template' => '{label} <div class="col-sm-10">{input}{error}{hint}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ]
        ]) ?>

        <?= $form->field($model, 'censor', [
            'template' => '<div class="col-sm-offset-2 col-sm-10"><div class="checkbox"><label>{input}{label}</label></div></div>',
            'inputOptions' => [
                'value' => 1,
            ],
            'labelOptions' => ['class' => ''],   
        ])->checkbox(['value' => '1']) ?>
    
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton(Yii::t('common/title','Опубликовать'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

        <div class="msg-to-user well col-sm-offset-2">
            <?php 
                $session = Yii::$app->session;
                echo $session->getFlash('postAdded'); 
            ?>
        </div>

    </section>

    <?= $this->render('rules/rules') ?>
    
    <div id="ajaxreq"></div>

</main><!-- poems -->
