<?php

use yii\helpers\Html;
use yii\helpers\Url;


$options = ['class' => 'art']; //blur-text

if ($post->censor == 1){
    Html::addCssClass($options, 'censor');
}

$this->title = $post->title;
?>

<main class="main-page-post row comment-container">
	<div class="poems-row">
		<section class="col-md-4 comment-section">
			<article class="post-poem">
				<div class="poem-wrap">
					<header class="poem-header">
						<?= Html::tag('h3',  Html::encode($post->title), ['class' => 'poem-title']) ?>
					</header>
					<div class="poem-body">
						<?= Html::tag('div', Html::encode($post->poem), ['class' => 'poem-poem-without']) ?>						
					</div>
					<footer class="poem-footer">
						<?= Html::tag('div','<span>'.\Yii::t('common/main', 'Автор').': '.'</span>'. Html::encode($post->autor), ['class' => 'poem-autor']) ?>	
						<?= Html::tag('time','<span>'.\Yii::t('common/main', 'Дата публикации').': '.'</span>'. Html::encode($post->date), ['class' => 'poem-date']) ?>
						<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
			            <script src="//yastatic.net/share2/share.js"></script>
			            <div class="ya-share2 share poems-row" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>			            
					</footer>
				</div>
			</article>
		</section>

		<section class="col-md-8 comment-tab circle-border" id="poem">
			<?= $this->render('comments', [
					'model' => $model,
					'comments' => $comments,
					'id_post' => $post->id,
					'count' => $count,
				]) ?>
		</section>

	</div>
</main>
