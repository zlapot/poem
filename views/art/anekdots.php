<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;

if(($pagination->pageCount-1 != $pagination->page))
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-default btn-lg active center-block", 'id'=>"btn-more-ank"];
else
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'id'=>"btn-more-ank", 'disabled'=>'disabled'];

$this->title = \Yii::t('common', 'Анекдоты');
?>


<main class="main-page-post col-md-9">

<section class="row poems-row">
	<?= Html::tag('h2', \Yii::t('common', 'Анекдоты') , ['class' => 'main-page-title']) ?>
    
    <?php foreach ($anekdots as $anekdot): ?>                   
        <?= $this->render('_anekdot', [
            'anekdot' => $anekdot,
            'isComment' => true,
        ]) ?>
    <?php endforeach; ?>    

    <?=
    Html::button(
	        Html::tag('span', '', ['class'=>"glyphicon glyphicon-refresh", 'aria-hidden'=>"true"]).\Yii::t('common/main', 'Загрузить еще'),
	        $options
	    )
	?>

	<?= LinkPager::widget(['pagination' => $pagination]) ?> 
</section>
</main>



<div class="aside sidebar col-md-3">
	<aside class="aside-block">

	</aside>
</div>


<script id="entry-template" type="text/x-handlebars-template">
{{#each data}}
  <article class="post-anekdot col-md-12">
    <div class="anekdot-wrap">  
      <div class="anekdot-body">
        <div class="anekdot-anekdot">{{anekdot}}</div> 
        <a class="btn btn-dafault btn-comment" href="/poem/web/art/anekdot?id={{id}}"><?= \Yii::t('common/main', 'Комментировать') ?></a>      
      </div>
      <footer class="anekdot-footer">
        <div class="anekdot-autor"><span><?= \Yii::t('common/main', 'Автор').': ' ?></span>{{autor}}</div> 
        <time class="anekdot-date"><span><?= \Yii::t('common/main', 'Дата публикации').': ' ?></span>{{date}}</time>    </footer>
    </div>
  </article>
{{/each}}
</script>
