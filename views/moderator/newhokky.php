<?php
// $pagination1, $pagination2 as Pagination()
// $newpost, $publpost as Poems()


use app\models\Lang;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;



$this->title = \Yii::t('common', 'Хокку');
$i = 0;
$countN = count($newpost)-1;
$countP = count($publpost)-1;

if($pagination1->pageCount > 1 && ($pagination1->pageCount-1 != $pagination1->page))
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-default btn-lg active center-block"];
else
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'disabled'=>'disabled'];

?>


<main id='main-container' class="main-page-post col-md-9">

	<?= Html::tag('h2', \Yii::t('common', 'Хокку') , ['class' => 'main-page-title']) ?>


	<ul class="nav nav-tabs flat-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Новые хокку</a></li>
	    <li role="presentation"><a href="#publ" aria-controls="publ" role="tab" data-toggle="tab">Опубликованные</a></li>
	</ul>

	  <!-- Tab panes -->
	<div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="new">

	    	<?php foreach ($newpost as $post): ?>				
					
					<div class="moder_wrap col-md-4">
						<?= $this->render('templ/_hokky', [
							'hokky' => $post,
						]) ?>
						<div class="moder-btn">
						<?= Html::a("Редактировать", Url::to(['moderator/edithokky', 'id' => $post->id]), ['class' => 'btn btn-primary', 'role' => 'button']) ?>
						<?= Html::a("Удалить", Url::to(['api/delete-post', 'id' => $post->id]), ['class' => 'btn btn-danger', 'role' => 'button']) ?>
						</div>
					</div>

		        
			<?php endforeach; ?>

			<?=
			    Html::tag('div',
			      	Html::button(
			          	Html::tag('span', '', ['class'=>"glyphicon glyphicon-refresh", 'aria-hidden'=>"true"]).\Yii::t('common/main', 'Загрузить еще'),
			          	$options
			        ),
			    ['class' => 'row', 'id' => 'insert'])
		  	?>
		 	<?= LinkPager::widget(['pagination' => $pagination1]) ?> 
		    	
	    </div>
	    <div role="tabpanel" class="tab-pane" id="publ">
	    	<?php foreach ($publpost as $post): ?>
									
					<div class="moder_wrap col-md-4">
						<?= $this->render('templ/_hokky', [
							'hokky' => $post,
						]) ?>
						<div class="moder-btn">
						<?= Html::a("Редактировать", Url::to(['moderator/edithokky', 'id' => $post->id]), ['class' => 'btn btn-primary', 'role' => 'button']) ?>
						<?= Html::a("Удалить", Url::to(['api/delete-post', 'id' => $post->id]), ['class' => 'btn btn-danger', 'role' => 'button']) ?>
						</div>
					</div>
		        
			<?php endforeach; ?>

			<?=
			    Html::tag('div',
			      	Html::button(
			          	Html::tag('span', '', ['class'=>"glyphicon glyphicon-refresh", 'aria-hidden'=>"true"]).\Yii::t('common/main', 'Загрузить еще'),
			          	$options
			        ),
			    ['class' => 'row', 'id' => 'insert'])
		  	?>
		 	<?= LinkPager::widget(['pagination' => $pagination2]) ?> 
	    </div>
	</div>


</main>

  
<div class="aside sidebar col-md-3">
  <aside class="aside-block">

  </aside>
</div>  