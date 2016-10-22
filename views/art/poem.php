<?php

use yii\helpers\Html;
use yii\helpers\Url;


$options = ['class' => 'art']; //blur-text

if ($poem->censor == 1){
    Html::addCssClass($options, 'censor');
}

$this->title = $poem->title;
?>

<main class="main-page-post row comment-container">
	<div class="poems-row">
		<section class="col-md-4 comment-section">
			<article class="post-poem">
				<div class="poem-wrap">
					<header class="poem-header">
						<?= Html::tag('h3',  Html::encode($poem->title), ['class' => 'poem-title']) ?>
					</header>
					<div class="poem-body">
						<?= Html::tag('div', Html::encode($poem->poem), ['class' => 'poem-poem-without']) ?>						
					</div>
					<footer class="poem-footer">
						<?= Html::tag('div','<span>Автор: </span>'. Html::encode($poem->autor), ['class' => 'poem-autor']) ?>	
						<?= Html::tag('time','<span>Дата публикации: </span>'. Html::encode($poem->date), ['class' => 'poem-date']) ?>
					</footer>
				</div>
			</article>
		</section>

		<section class="col-md-8 comment-tab circle-border" id="poem">
			<?= $this->render('comments', [
					'model' => $model,
					'comments' => $comments,
					'id_poem' => $poem->id,
				]) ?>
		</section>

	</div>
</main>
