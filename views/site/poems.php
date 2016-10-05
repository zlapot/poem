<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Poems */
/* @var $form ActiveForm */
?>
<div class="row">
    <div class="col-md-8">

    <?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    ]); ?>
        
        <?= $form->field($model, 'title', [
            'template' => '{label} <div class="col-sm-10">{input}{error}{hint}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ]
        ]) ?>        

        <?= $form->field($model, 'poem', [
            'template' => '{label} <div class="col-sm-10">{input}{error}{hint}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ]
        ])->textarea(['rows' => 20, 'cols' => 5]) ?>

        <?= $form->field($model, 'autor', [
            'template' => '{label} <div class="col-sm-10">{input}{error}{hint}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ]
        ]) ?>

        <?= $form->field($model, 'censor', [
            'template' => '<div class="col-sm-offset-2 col-sm-10"><div class="checkbox">{label}{input}</div></div>'
        ])->checkbox() ?>
    
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

    </div>

    <div class="col-md-4 offset-right blockquote-reverse">
        Какие-то правила:
        <ul class="poem-rule">
            <li class="item-rule">правило</li>
            <li class="item-rule">правило</li>
            <li class="item-rule">правило</li>
            <li class="item-rule">правило</li>
            <li class="item-rule">правило</li>
        </ul>
    </div>
</div><!-- poems -->
