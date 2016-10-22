<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;

$opt = ['class' => 'post-hokky'];

if($pagination->pageCount > 1 && ($pagination->pageCount-1 != $pagination->page))
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-default btn-lg active center-block", 'id'=>"btn-more-hokky"];
else
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'id'=>"btn-more-hokky", 'disabled'=>'disabled'];

$this->title = 'Хокку';
?>

<main id='main-container' class="main-page-post col-md-9">
    <section class="row poems-row">
        <?= Html::tag('h2', "Хокку" , ['class' => 'main-page-title']) ?>

        
        <?php foreach ($hokkys as $hokky): ?>
                <?= $this->render('_hokky', [
                    'hokky' => $hokky,
                    'opt' => $opt,
                ]) ?>
        <?php endforeach; ?>
        

        <?=
        Html::tag('div',
          Html::button(
              Html::tag('span', '', ['class'=>"glyphicon glyphicon-refresh", 'aria-hidden'=>"true"]).'Загрузить ещё',
              $options
            ),
          ['id' => 'insert'])
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
<article class="post-hokky col-md-4"> <div class="hokky-wrap">
    <div class="hokky-body">
        <div class="hokky-hokky">{{hokky}}</div>  
            <a class="btn btn-dafault btn-comment" href="/poem/web/art/hokky?id=9">Коммментировать</a>          
         </div>
        <footer class="hokky-footer">
            <div class="hokky-autor"><span>Автор: </span>{{autor}}</div> 
            <time class="hokky-date"><span>Дата публикации: </span>{{date}}</time> 
        </footer>
    </div>
</article>
{{/each}}
</script>



