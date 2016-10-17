<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;

if($pagination->pageCount > 1 && ($pagination->pageCount-1 != $pagination->page))
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'id'=>"btn-more-ank"];
else
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'id'=>"btn-more-ank", 'disabled'=>'disabled'];

$this->title = 'My Yii Application';
?>


<div id='main-container' class="container  block-quote">

    <?php foreach ($anekdots as $anekdot): ?>        
            
        <?= $this->render('_anekdot', [
            'anekdot' => $anekdot,
        ]) ?>

    <?php endforeach; ?>    

</div>

<?=
    Html::button(
        Html::tag('span', '', ['class'=>"glyphicon glyphicon-refresh", 'aria-hidden'=>"true"]).'Загрузить ещё',
        $options
    )
?>

<?= LinkPager::widget(['pagination' => $pagination]) ?> 