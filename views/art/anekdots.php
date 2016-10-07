<?php
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>


<div id='main-container' class="container  block-quote">

    <?php foreach ($anekdots as $anekdot): ?>        
            
        <?= $this->render('_anekdot', [
            'anekdot' => $anekdot,
        ]) ?>

    <?php endforeach; ?>    

</div>

<button type="button" id="btn-more-ank" class="btn btn-primary btn-lg active center-block">
    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>  Загрузить ещё
</button>

<?= LinkPager::widget(['pagination' => $pagination]) ?> 