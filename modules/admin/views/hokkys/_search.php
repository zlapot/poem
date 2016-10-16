<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\HokkysSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hokkys-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'hokky') ?>

    <?= $form->field($model, 'autor') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'utime') ?>

    <?php // echo $form->field($model, 'censor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
