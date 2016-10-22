<?php
	use yii\helpers\html;
	use yii\helpers\Url;	
	use yii\bootstrap\ActiveForm;
	use kartik\file\FileInput;

?>
<main class="main-page-content col-md-9">
	
	
	<section class="main-page-post row">		
		<?= Html::tag('h2', "Профиль пользователя" , ['class' => 'main-page-title']) ?>
		<article class="profile-post">
			<head>
				<?= Html::tag('h3', "Информация о пользователе:" , ['class' => 'main-page-title']) ?>
			</head>
			<div class="body-profile">
				<div class="profile-left">
				<?= Html::tag('div', "<span>Логин: </span>".Html::encode($user->username), ['class'=>'profile-usermane']) ?>
				<?= Html::tag('div', "<span>Дата регистрации: </span>".gmdate("Y-m-d H:i:s", Html::encode($user->created_at)), ['class'=>'profile-date']) ?>
				</div>
				<div class="profile-right">
				<?= Html::img(Url::home().$user->img, ['class' => 'profile-img']) ?>
				</div>
			</div>
		</article>
		<article class="profile-post">
			<head>
				<?= Html::tag('h3', "Выберите аватар" , ['class' => 'main-page-title']) ?>
			</head>
			<div class="col-sm-1"></div>
			<div class="col-sm-10 body-image">
				<?php
					for($i=1; $i<21; $i++){
						$path = Url::home().'img/avatar/'.$i.'.jpg';
						echo '<div class="ava-img">
								<img src="'.$path.'" class="avatar" data-image="'.$i.'"/>
								</div>';
					}

				?>
				<p id="error"></p>
			</div>
			<div class="col-sm-1"></div>
		</article>

	</section>

	<?php if(!$user->service) : ?>
	<section class="main-page-post row">

		<?= Html::tag('h3', "Изменить пароль:" , ['class' => 'main-page-title']) ?>
			<?php $form = ActiveForm::begin([
		        'id' => 'change-form',
		        'options' => ['class' => 'form-horizontal'],
		        'fieldConfig' => [
		            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
		            'labelOptions' => ['class' => 'col-lg-2 control-label'],
		        ],
		    ]); ?>
		        

	        <?= $form->field($password, 'password')->passwordInput() ?>
	        <?= $form->field($password, 'newpassword')->passwordInput() ?>

	        

	        <div class="form-group">
	            <div class="col-lg-offset-2 col-lg-10">
	                <?= Html::submitButton('Изменить пароль', ['class' => 'btn btn-primary', 'name' => 'change-password-button']) ?>	                
	            </div>
	           
	        </div>

	    <?php ActiveForm::end(); ?>


	</section>
	
	<?php endif; ?> 
	
	<section class="main-page-post row">

		<?= Html::tag('h3', "Загрузить аватар:" , ['class' => 'main-page-title']) ?>
		<?php $form = ActiveForm::begin(['id' => 'upload-form', 'options' => ['enctype' => 'multipart/form-data']]) ?>		    

		    <?= $form->field($load, 'imageFile')->widget(FileInput::classname(), [
				    'options' => ['accept' => 'image/*'],
				    'resizeImages' => true,
				]) ?>

		   

		<?php ActiveForm::end() ?>
		
		<div id="txt"></div>
	</section>
	
</main>

<div class="aside sidebar col-md-3">
	<aside class="aside-block">

	</aside>
</div>

