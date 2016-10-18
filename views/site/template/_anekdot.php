<?php
	use yii\helpers\html;
	use yii\helpers\Url;

?>

<article class="post-anekdot col-md-12">
	<div class="hokky-wrap">	
		<div class="anekdot-body">
			<?= Html::tag('div', Html::encode($anekdot->anekdot), ['class' => 'anekdot-anekdot']) ?>	
			<?= Html::a('Комментировать', Url::to(['art/anekdot', 'id'=>$anekdot->id]), ['class' => 'btn btn-dafault btn-comment']) ?>			
		</div>
		<footer class="anekdot-footer">
			<?= Html::tag('div','<span>Автор: </span>'. Html::encode($anekdot->autor), ['class' => 'anekdot-autor']) ?>	
			<?= Html::tag('time','<span>Дата публикации: </span>'. Html::encode($anekdot->date), ['class' => 'anekdot-date']) ?>
		</footer>
	</div>
</article>