<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Anekdots */

$this->title = 'Create Anekdots';
$this->params['breadcrumbs'][] = ['label' => 'Anekdots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anekdots-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
