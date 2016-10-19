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




<article class="post-anekdot col-md-12 poems-row">
	<div class="anekdot-wrap">	
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