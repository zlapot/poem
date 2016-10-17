<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
		<?= Html::tag('div',
				Html::tag('div', Html::encode($hokky->hokky), $options) .
				Html::tag('div', "Автор: ".Html::encode($hokky->autor), ['class' => 'hokky-autor']).
				Html::a('Комментировать', Url::to(['art/hokky', 'id' => $hokky->id]), ['class' => 'btn btn-dafault'])
				,
			['data-link' => Url::to(['art/hokky', 'id' => $hokky->id]), 'class' => 'bl-hokky center-block']
		) ?>
	</div>
</div>


