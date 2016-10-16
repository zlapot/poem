<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CommentsPoem */

$this->title = 'Create Comments Poem';
$this->params['breadcrumbs'][] = ['label' => 'Comments Poems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-poem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
