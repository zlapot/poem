<?php

use yii\helpers\html;
use yii\helpers\Url;

?>

<main class="main-page-content col-md-9">
	
	<section class="main-page-post row">		
		<?= Html::tag('h2', "Новые стихи" , ['class' => 'main-page-title']) ?>
		<div class="row poems-row">
			<?php foreach ($poems as $poem): ?>
				<?= $this->render('template/_poem', [
					'poem' => $poem,
				])?>		
			<?php endforeach; ?>
		</div>
		<?= Html::a('Больше стихов...', Url::to(['art/poems']), ['class' => 'btn btn-dafault main-page-more']) ?>
	</section>

	<section class="main-page-post row">
		<?= Html::tag('h2', "Новые анекдоты" , ['class' => 'main-page-title']) ?>
			<?php foreach ($anekdots as $anekdot): ?>
			<?= $this->render('template/_anekdot', [
				'anekdot' => $anekdot,
			])?>
		<?php endforeach; ?>
		<?= Html::a('Больше анекдотов...', Url::to(['art/anekdots']), ['class' => 'btn btn-dafault main-page-more']) ?>
	</section>

	<section class="main-page-post row">
		<?= Html::tag('h2', "Новые хокку" , ['class' => 'main-page-title']) ?>
			<?php foreach ($hokkys as $hokky): ?>
			<?= $this->render('template/_hokky', [
				'hokky' => $hokky,
			])?>		
		<?php endforeach; ?>
		<?= Html::a('Больше хокку...', Url::to(['art/hokkys']), ['class' => 'btn btn-dafault main-page-more']) ?>
	</section>
</main>

<div class="aside sidebar col-md-3">
	<aside class="aside-block">

	</aside>
</div>

