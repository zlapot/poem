<?php
use yii\helpers\Html;
use yii\helpers\Url;

$options = ['class' => 'art']; //blur-text

if ($poem->censor == 1){
    Html::addCssClass($options, 'censor');
}

$this->title = $poem->title;
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 bl-post">
			<?= Html::tag('div',
					Html::tag('div', 'Название: '.Html::encode($poem->title), ['class' => 'art-title']) .
					Html::tag('div', Html::encode($poem->poem), $options) .
					Html::tag('div', 'Автор: '.Html::encode($poem->autor), ['class' => 'art-autor']),
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
