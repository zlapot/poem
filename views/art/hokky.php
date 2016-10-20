<?php
use yii\helpers\Html;
use yii\helpers\Url;

$options = ['class' => 'art']; //blur-text

if ($hokky->censor == 1){
    Html::addCssClass($options, 'censor');
}

//$this->title = "title";
?>

<main class="main-page-post">
	<div class="row poems-row">
		<div class="col-md-4 comment-section">
			 <?= $this->render('_hokky2', [
	            'hokky' => $hokky,
	        ]) ?>
		</div>

		<div class="col-md-8 circle-border">
			<?= $this->render('comments', [
					'model' => $model,
					'comments' => $comments,
				]) ?>
		</div>

	</div>
</main>
