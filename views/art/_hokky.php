<?php

use yii\helpers\Html;

?>

<?php
$options = ['class' => 'hokky']; //blur-text

if ($hokky->censor == 1){
    Html::addCssClass($options, 'censor');
}
?>

<div class="">
	<div class="col-md-8 .hidden-xs"></div>	
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="bl-hokky center-block">
			<?= Html::tag('div', Html::encode($hokky->hokky), $options) ?>
			<?= Html::tag('div', "Автор: ".Html::encode($hokky->autor), ['class' => 'hokky-autor']) ?> 
		</div>
	</div>
</div>


