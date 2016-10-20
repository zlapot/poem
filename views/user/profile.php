<?php
	use yii\helpers\html;
	use yii\helpers\Url;	
	use yii\bootstrap\ActiveForm;

?>
<main class="main-page-content col-md-9">
	
	<section class="main-page-post row">		
		<?= Html::tag('h2', "Профиль пользователя" , ['class' => 'main-page-title']) ?>
		<div class="row poems-row">
			
		</div>
		<article>
		<head>
			<?= Html::tag('h3', "Выберите аватар" , ['class' => 'main-page-title']) ?>
		</head>
		<div class="col-sm-1"></div>
		<div class="body-image col-sm-10">
			<?php
				for($i=1; $i<21; $i++){
					echo '<div class="ava-img">
							<img src="/poem/web/img/avatar/'.$i.'.jpg" class="avatar"
							</div';
				}

			?>
		</div>
		<div class="col-sm-1"></div>
		</article>

	</section>

	<section class="main-page-post">

		<?php $form = ActiveForm::begin([
	        'id' => 'login-form',
	        'options' => ['class' => 'form-horizontal'],
	        'fieldConfig' => [
	            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
	            'labelOptions' => ['class' => 'col-lg-1 control-label'],
	        ],
	    ]); ?>
	        

	        <?= $form->field($password, 'password')->passwordInput() ?>
	        <?= $form->field($password, 'newpassword')->passwordInput() ?>

	        

	        <div class="form-group">
	            <div class="col-lg-offset-1 col-lg-11">
	                <?= Html::submitButton('Изменить пароль', ['class' => 'btn btn-primary', 'name' => 'change-password-button']) ?>	                
	            </div>
	           
	        </div>

	    <?php ActiveForm::end(); ?>

			
	</section>
	
</main>

<div class="aside sidebar col-md-3">
	<aside class="aside-block">

	</aside>
</div>

