<?php

$this->title = 'Поэзия души и не только';
$i = 0;
?>

<div class="container">
	<?php foreach ($poems as $poem): ?>


		<?php if($i%3 === 0) echo '<div class="row">' ?>
			
			<?= $this->render('_poem', [
				'poem' => $poem,
			]) ?>

        <?php 
        	if($i%3 === 2) echo '</div>';
        	$i++; 
        ?>
	<?php endforeach; ?>


</div>

<!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>