<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\HokkysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hokkys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hokkys-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hokkys', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_user',
            'hokky:ntext',
            'autor',
            'date',
            // 'utime:datetime',
            // 'censor',
			'isDelete',
			'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
