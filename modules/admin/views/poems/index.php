<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PoemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Poems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poems-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Poems', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_user',
            'title',
            'poem:ntext',
            'autor',
            // 'date:ntext',
            // 'censor',
			'isDelete',
			'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
