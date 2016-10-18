<?php
	use yii\helpers\html;
	use yii\helpers\Url;
	use app\models\Poems;

?>

<article class="post-poem col-md-6">
	<div class="poem-wrap">
		<header class="poem-header">
			<?= Html::tag('h3',  Html::encode($poem->title), ['class' => 'poem-title']) ?>
		</header>
		<div class="poem-body">
			<?= Html::tag('div', Html::encode(Poems::cutStr($poem->poem, 350)), ['class' => 'poem-poem']) ?>	
			<?= Html::a('Показать полностью...', Url::to(['art/poem', 'id'=>$poem->id]), ['class' => 'btn btn-dafault btn-comment']) ?>			
		</div>
		<footer class="poem-footer">
			<?= Html::tag('div','<span>Автор: </span>'. Html::encode($poem->autor), ['class' => 'poem-autor']) ?>	
			<?= Html::tag('time','<span>Дата публикации: </span>'. Html::encode($poem->date), ['class' => 'poem-date']) ?>
		</footer>
	</div>
</article>