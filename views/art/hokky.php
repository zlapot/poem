<?php
use yii\helpers\Html;
use yii\helpers\Url;

$options = ['class' => 'art']; //blur-text

if ($hokky->censor == 1){
    Html::addCssClass($options, 'censor');
}

//$this->title = "title";
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 bl-post">
			<?= Html::tag('div',
					Html::tag('div', Html::encode($hokky->hokky), $options) .
					Html::tag('div', 'Автор: '.Html::encode($hokky->autor), ['class' => 'art-autor']),
				['class' => 'bl-art']
			) ?> 
		</div>

		<div class="col-md-8">
			<?= $this->render('comments', [
					'model' => $model,
					'comments' => $comments,
				]) ?>
		</div>

	</div>
</div>
