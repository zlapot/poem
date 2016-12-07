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


<article class="post-anekdot">
	<div class="anekdot-wrap">	
		<div class="anekdot-body">
			<?= Html::tag('div', Html::encode($anekdot->anekdot), ['class' => 'anekdot-anekdot']) ?>
			
			<?= Html::a(Yii::t('common/main', Yii::t('common/main', 'Комментировать')), Url::to(['art/anekdot', 'id'=>$anekdot->id]), ['class' => 'btn btn-dafault btn-comment']) ?>	
						
		</div>
		<footer class="anekdot-footer">
			<?= Html::tag('div','<span>'.Yii::t('common/main', 'Автор').': '.'</span>'. Html::encode($anekdot->autor), ['class' => 'anekdot-autor']) ?>	
			<?= Html::tag('time','<span>'.Yii::t('common/main', 'Дата публикации').': '.'</span>'. Html::encode($anekdot->date), ['class' => 'anekdot-date']) ?>			
		</footer>
	</div>
</article>