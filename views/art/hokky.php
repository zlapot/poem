<?php
use yii\helpers\Html;
use yii\helpers\Url;

$options = ['class' => 'art']; //blur-text

if ($post->censor == 1){
    Html::addCssClass($options, 'censor');
}

$this->title = Yii::t('common', 'Хокку');
?>

<main class="main-page-post row comment-container">
	<div class="poems-row">
		<div class="col-md-4 comment-section">
			 <?= $this->render('_hokky', [
	            'hokky' => $post,
	            'isComment' => false,
	        ]) ?>	        
		</div>

		<div class="col-md-8 comment-tab  circle-border" id="hokky">
			<?= $this->render('comments', [
					'model' => $model,
					'comments' => $comments,
					'id_post' => $post->id,
					'count' => $count,
				]) ?>
		</div>

	</div>
</main>
