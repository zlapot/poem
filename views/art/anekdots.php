<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;

if(($pagination->pageCount-1 != $pagination->page))
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-default btn-lg active center-block", 'id'=>"btn-more-ank"];
else
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'id'=>"btn-more-ank", 'disabled'=>'disabled'];

$this->title = 'My Yii Application';
?>


<main class="main-page-post col-md-9">

	<?= Html::tag('h2', "Новые анекдоты" , ['class' => 'main-page-title']) ?>
    
    <?php foreach ($anekdots as $anekdot): ?>        
            
        <?= $this->render('_anekdot', [
            'anekdot' => $anekdot,
        ]) ?>

    <?php endforeach; ?>    

    <?=
    Html::button(
	        Html::tag('span', '', ['class'=>"glyphicon glyphicon-refresh", 'aria-hidden'=>"true"]).'Загрузить ещё',
	        $options
	    )
	?>

	<?= LinkPager::widget(['pagination' => $pagination]) ?> 

</main>



<div class="aside sidebar col-md-3">
	<aside class="aside-block">

	</aside>
</div>