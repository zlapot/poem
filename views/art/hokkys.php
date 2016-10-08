<?php
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>


<div id='main-container' class="container hokky-container">

    <?php foreach ($hokkys as $hokky): ?>        
            
        <?= $this->render('_hokky', [
            'hokky' => $hokky,
        ]) ?>

    <?php endforeach; ?>    

</div>

<button type="button" id="btn-more-hokky" class="btn btn-primary btn-lg active center-block">
    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>  Загрузить ещё
</button>

<?= LinkPager::widget(['pagination' => $pagination]) ?> 