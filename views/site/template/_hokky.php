<?php
	use yii\helpers\html;
	use yii\helpers\Url;

?>

<article class="post-hokky col-md-4">	
	<div class="hokky-wrap">
		<div class="hokky-body">
			<?= Html::tag('div', Html::encode($hokky->hokky), ['class' => 'hokky-hokky']) ?>	
			<?= Html::a(Yii::t('common/main', 'Комментировать'), Url::to(['art/hokky', 'id'=>$hokky->id]), ['class' => 'btn btn-dafault btn-comment']) ?>			
		</div>
		<footer class="hokky-footer">
			<?= Html::tag('div','<span>'.Yii::t('common/main', 'Автор').": ".'</span>'. Html::encode($hokky->autor), ['class' => 'hokky-autor']) ?>	
			<?= Html::tag('time','<span>'.Yii::t('common/main', 'Дата публикации').': '.'</span>'. Html::encode($hokky->date), ['class' => 'hokky-date']) ?>
		</footer>
	</div>
</article>