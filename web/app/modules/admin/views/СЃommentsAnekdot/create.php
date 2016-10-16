<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CommentsAnekdot */

$this->title = 'Create Comments Anekdot';
$this->params['breadcrumbs'][] = ['label' => 'Comments Anekdots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-anekdot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
