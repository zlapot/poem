<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php
$options = ['class' => 'anekdot']; //blur-text

if ($anekdot->censor == 1){
    Html::addCssClass($options, 'censor');
}
?>


<article class="post-anekdot col-md-12">
	<div class="anekdot-wrap">	
		<div class="anekdot-body">
			<?= Html::tag('div', Html::encode($anekdot->anekdot), ['class' => 'anekdot-anekdot']) ?>
			<?php if($isComment): ?>
			<?= Html::a(Yii::t('common/main', Yii::t('common/main', 'Комментировать')), Url::to(['art/anekdot', 'id'=>$anekdot->id]), ['class' => 'btn btn-dafault btn-comment']) ?>
			<?php else:
				echo '</br>';
			endif; ?>			
		</div>
		<footer class="anekdot-footer">
			<?= Html::tag('div','<span>'.Yii::t('common/main', 'Автор').': '.'</span>'. Html::encode($anekdot->autor), ['class' => 'anekdot-autor']) ?>	
			<?= Html::tag('time','<span>'.Yii::t('common/main', 'Дата публикации').': '.'</span>'. Html::encode($anekdot->date), ['class' => 'anekdot-date']) ?>
			<?php if(!$isComment): ?>
				<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
				<script src="//yastatic.net/share2/share.js"></script>
				<div class="ya-share2 share poems-row" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>	
			<?php endif; ?>
		</footer>
	</div>
</article>