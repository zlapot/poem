<?php

use yii\helpers\Html;

?>

<?php
$options = ['class' => 'poem blur-text'];

if ($poem->censor == 1){
    Html::addCssClass($options, 'censor');
}
?>

<div class="col-md-4 bl-post">
	<div class="bl-poem">
		<?= Html::tag('div', Html::encode($poem->title), ['class' => 'poem-title']) ?>
		<?= Html::tag('div', Html::encode($poem->poem), $options) ?>
		<?= Html::tag('div', Html::encode($poem->autor), ['class' => 'poem-autor']) ?>	
	</div>  
</div>