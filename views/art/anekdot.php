<?php
use yii\helpers\Html;
use yii\helpers\Url;

$options = ['class' => 'art']; //blur-text

if ($anekdot->censor == 1){
    Html::addCssClass($options, 'censor');
}

//$this->title = "title";
?>

<main class="main-page-post">
	<div class="row poems-row">
		<section class="col-md-4 comment-section">			      
	        <?= $this->render('_anekdot', [
	            'anekdot' => $anekdot,
	        ]) ?>
		</section>

		<section class="col-md-8 circle-border">
			<?= $this->render('comments', [
					'model' => $model,
					'comments' => $comments,
				]) ?>
		</section>

	</div>
</main>
