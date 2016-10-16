<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Hokkys */

$this->title = 'Create Hokkys';
$this->params['breadcrumbs'][] = ['label' => 'Hokkys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hokkys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
