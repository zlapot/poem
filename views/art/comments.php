
<?php
use yii\helpers\Html;

?>

<ul class="nav nav-tabs flat-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?= Yii::t('common/main', 'На сайте') ?></a></li>
    <li role="presentation"><a href="#vk" aria-controls="vk" role="tab" data-toggle="tab">Vk</a></li>
    <li role="presentation"><a href="#fb" aria-controls="fb" role="tab" data-toggle="tab">Facebook</a></li>
 </ul>

  <!-- Tab panes -->
 <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<?= $this->render('_comment', [
    			'model' => $model,
				'comments' => $comments,
				'id_post' => $id_post,
				'count' => $count,
			]) ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="vk">
    	<!-- Put this script tag to the <head> of your page -->
		<script type="text/javascript" src="//vk.com/js/api/openapi.js?132"></script>

		<script type="text/javascript">
		  VK.init({apiId: 5661534, onlyWidgets: true});
		</script>

		<!-- Put this div tag to the place, where the Comments block will be -->
		<div id="vk_comments" class=''></div>
		<script type="text/javascript">
		VK.Widgets.Comments("vk_comments", {limit: 10,attach: "*", color1: "2B2B2B"});
		</script>
    </div>
    <div role="tabpanel" class="tab-pane" id="fb">
    	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.8";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-comments" data-href="http://localhost/poem" data-numposts="5"></div>
    </div>
</div>

<script id="entry-template" type="text/x-handlebars-template">
{{#each data}}
<article class="comment" id="{{id}}">
	<div class="comment-img">
		<img src="/poem/web/{{img}}" alt="...">     
	</div>
	<div class="comment-body">
		<div class="comment-title">
			<div class="comment-username"><span>Написал: </span>{{username}}</div>             
			<div class="comment-date"><span>Дата: </span>{{date}}</div>      
			<button type="button" class="daeleteBtn" data-id="{{id}}">X</button>      
		</div>
		<div class="comment-text">{{comment}}</div>    
	</div>
</article>
{{/each}}
</script>