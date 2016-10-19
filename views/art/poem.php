<?php

use yii\helpers\Html;
use yii\helpers\Url;


$options = ['class' => 'art']; //blur-text

if ($poem->censor == 1){
    Html::addCssClass($options, 'censor');
}

$this->title = $poem->title;
?>

<main class="main-page-post">
	<div class="row poems-row">
		<section class="col-md-4">
			<article class="post-poem">
				<div class="poem-wrap">
					<header class="poem-header">
						<?= Html::tag('h3',  Html::encode($poem->title), ['class' => 'poem-title']) ?>
					</header>
					<div class="poem-body">
						<?= Html::tag('div', Html::encode($poem->poem), ['class' => 'poem-poem-without']) ?>	
						<?= Html::a('Показать полностью...', Url::to(['art/poem', 'id'=>$poem->id]), ['class' => 'btn btn-dafault btn-comment']) ?>			
					</div>
					<footer class="poem-footer">
						<?= Html::tag('div','<span>Автор: </span>'. Html::encode($poem->autor), ['class' => 'poem-autor']) ?>	
						<?= Html::tag('time','<span>Дата публикации: </span>'. Html::encode($poem->date), ['class' => 'poem-date']) ?>
					</footer>
				</div>
			</article>
		</section>

		<section class="col-md-8 circle-border">
			<?= $this->render('comments', [
					'model' => $model,
					'comments' => $comments,
				]) ?>
		</section>

	</div>
</main>
