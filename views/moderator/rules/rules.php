<?php
use app\models\Lang;
	$rule = 'rules'.'0';
	
	switch (\Yii::$app->language) {
		case 'ru':
			$rule = 'rules'.'0';
			break;
		case 'en':
			$rule = 'rules'.'1';
			break;
		case 'bb':
			$rule = 'rules'.'2';
			break;
		case 'ua':
			$rule = 'rules'.'3';
			break;
		case 'im':
			$rule = 'rules'.'4';
			break;
		case 'de':
			$rule = 'rules'.'7';
			break;
		case 'fr':
			$rule = 'rules'.'8';
			break;


		default:
			$rule = 'rules'.'0';
			break;
	}
		
	

?>

<?= $this->render($rule) ?>