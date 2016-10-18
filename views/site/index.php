<?php

use yii\helpers\html;

?>

<main class="main-page-content col-md-9">
	<section class="main-page-post row">
		<article class="main-page-post-poem">
			<?= Html::tag('h2', "Новые стихи" , ['class' => 'post-title']) ?>
			<?= Html::tag('div', Html::encode($poem->poem), ['class' => 'poem-main-page']) ?>
		</article>
	</section>

	<section class="main-page-post row">
		<article class="main-page-post-hokky">
			<?= Html::tag('h2', "Новые хокку" , ['class' => 'post-title']) ?>
			<?= Html::tag('div', Html::encode($poem->poem), ['class' => 'hokky-main-page']) ?>
		</article>
	</section>

	<section class="main-page-post row">
		<article class="main-page-anekdot">
			<?= Html::tag('h2', "Новые анекдоты" , ['class' => 'post-title']) ?>
			<?= Html::tag('div', Html::encode($poem->poem), ['class' => 'anekdot-main-page']) ?>
		</article>
	</section>
</main>

<div class="main-page-aside col-md-3">
	<aside>

	</aside>
</div>

