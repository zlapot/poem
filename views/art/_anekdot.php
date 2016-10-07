<?php

use yii\helpers\Html;

?>

<?php
$options = ['class' => 'anekdot']; //blur-text

if ($anekdot->censor == 1){
    Html::addCssClass($options, 'censor');
}
?>

<div class="cblock-quote col-md-12">
	<div class="bl-anekdot">
		<?= Html::tag('div', Html::encode($anekdot->poem), $options) ?>
		<?= Html::tag('div', Html::encode($anekdot->autor), ['class' => 'anekdot-autor']) ?>	
	</div>  
</div>