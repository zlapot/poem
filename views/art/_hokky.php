<?php
	use yii\helpers\html;
	use yii\helpers\Url;


if (isset($opt))
	echo '<article class="post-hokky col-md-4">';
else	
	echo '<article class="post-hokky">';
?>
	<div class="hokky-wrap">
		<div class="hokky-body">
			<?= Html::tag('div', Html::encode($hokky->hokky), ['class' => 'hokky-hokky']) ?>	
			<?php if($isComment): ?>
			<?= Html::a(Yii::t('common/main', 'Комментировать'), Url::to(['art/hokky', 'id'=>$hokky->id]), ['class' => 'btn btn-dafault btn-comment']) ?>		
			<?php else:
				echo '</br>';
			endif; ?>
		</div>
		<footer class="hokky-footer">
			<?= Html::tag('div','<span>'.Yii::t('common/main', 'Автор').': '.'</span>'. Html::encode($hokky->autor), ['class' => 'hokky-autor']) ?>	
			<?= Html::tag('time','<span>'.Yii::t('common/main', 'Дата публикации').': '.'</span>'. Html::encode($hokky->date), ['class' => 'hokky-date']) ?>
			<?php if(!$isComment): ?>
				<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
				<script src="//yastatic.net/share2/share.js"></script>
				<div class="ya-share2 share poems-row" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>	
			<?php endif; ?>
		</footer>
	</div>
</article>
