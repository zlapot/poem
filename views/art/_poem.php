<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php
$options = ['class' => 'poem']; //blur-text

if ($poem->censor == 1){
    Html::addCssClass($options, 'censor');
}
?>

<div class="col-md-4 bl-post">
	<?= Html::tag('div',
			Html::tag('div', Html::encode($poem->title), ['class' => 'poem-title']) .
			Html::tag('div', Html::encode($poem->poem), $options) .
			Html::tag('div', Html::encode($poem->autor), ['class' => 'poem-autor']),
		['data-link' => Url::to(['art/poem', 'id' => $poem->id]), 'class' => 'bl-poem']
	) ?> 
</div>