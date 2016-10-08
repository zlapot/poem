<?php

use yii\helpers\Html;

?>

<?php
$options = ['class' => 'hokky']; //blur-text

if ($hokky->censor == 1){
    Html::addCssClass($options, 'censor');
}
?>

<div class="row">
	<div class="col-md-8 .hidden-xs"></div>	
	<div class="col-md-4 bl-hokky" >
		<?= Html::tag('p', Html::encode($hokky->hokky), $options) ?>
		<?= Html::tag('p', "Автор: ".Html::encode($hokky->autor), ['class' => 'hokky-autor']) ?> 
	</div>
</div>


