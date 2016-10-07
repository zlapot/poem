<?php

use yii\helpers\Html;

?>

<?php
$options = ['class' => 'anekdot']; //blur-text

if ($anekdot->censor == 1){
    Html::addCssClass($options, 'censor');
}
?>

<div class="col-md-12 bl-anekdot " >
	<?= Html::tag('p', Html::encode($anekdot->anekdot), $options) ?>
	<?= Html::tag('p', "Автор: ".Html::encode($anekdot->autor), ['class' => 'anekdot-autor']) ?>		 
</div>