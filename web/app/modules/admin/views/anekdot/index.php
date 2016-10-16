<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AnekdotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anekdots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anekdots-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anekdots', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_user',
            'anekdot:ntext',
            'autor',
            'date',
            // 'utime:datetime',
            // 'censor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
