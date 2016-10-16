<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CommentsAnekdotSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-anekdot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_poem') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'utime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
