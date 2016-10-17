<?php
use app\models\Lang;
use yii\widgets\LinkPager;
use yii\helpers\Html;

$cookies = Yii::$app->request->cookies;
$language = $cookies->getValue('language', 'eng');

$lanID = Lang::getIndex($language) ? Lang::getIndex($language) : 0; 
$rule = 'rules'.$lanID;

$this->title = 'Поэзия души и не только';
$i = 0;
$count = count($poems)-1;


if($pagination->pageCount > 1 && ($pagination->pageCount-1 != $pagination->page))
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block"];
else
  $options = ['type'=>"button", 'id'=>"btn-more", 'class'=>"btn btn-primary btn-lg active center-block", 'disabled'=>'disabled'];

?>

<div id='main-container' class="container">
	<?php foreach ($poems as $poem): ?>


		<?php if($i%3 === 0) echo '<div class="row">' ?>
			
			<?= $this->render('_poem', [
				'poem' => $poem,
			]) ?>

        <?php 
        	if($i%3 === 2 || $i==$count) echo '</div>';
        	$i++; 
        ?>
	<?php endforeach; ?>

	

</div>

  
  <?=
    Html::button(
        Html::tag('span', '', ['class'=>"glyphicon glyphicon-refresh", 'aria-hidden'=>"true"]).'Загрузить ещё',
        $options
      )
  ?>
	

	<?= LinkPager::widget(['pagination' => $pagination]) ?> 

	<div id="ajaxreq"></div>

<!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-link="/poem/web/index.php?r=art%2Fpoems">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            <div class="modal-poem"></div>
            <div class="modal-autor"></div>
          </div>
          <div class="modal-footer">
          <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
            <script src="//yastatic.net/share2/share.js"></script>
            <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>
            <a href="#" class="btn btn-default modal-link" role="button">Комментировать</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>