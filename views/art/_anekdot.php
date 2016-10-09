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

<?= Html::tag('div',
		Html::tag('p', Html::encode($anekdot->anekdot), $options) .
		Html::tag('p', "Автор: ".Html::encode($anekdot->autor), ['class' => 'anekdot-autor']),	
	['data-link' => Url::to(['art/anekdots', 'id' => $anekdot->id]), 'class' => 'col-md-12 bl-anekdot']
) ?>
