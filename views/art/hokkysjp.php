<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;

if($pagination->pageCount > 1 && ($pagination->pageCount-1 != $pagination->page))
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'id'=>"btn-more-hokky"];
else
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'id'=>"btn-more-hokky", 'disabled'=>'disabled'];

$this->title = 'Хокку';
?>


<div id='main-container' class="container hokky-container">

    <?php foreach ($hokkys as $hokky): ?>        
            
        <?= $this->render('_hokky', [
            'hokky' => $hokky,
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

