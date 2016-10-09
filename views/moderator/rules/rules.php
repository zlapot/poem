<?php
use app\models\Lang;

	$cookies = Yii::$app->request->cookies;
	$language = $cookies->getValue('language', 'eng');

	$lanID = Lang::getIndex($language) ? Lang::getIndex($language) : 0; 
	$rule = 'rules'.$lanID;
	
	

?>

<?= $this->render($rule) ?>