<?php
$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/frame.css');
if(isset($this->CSS) && is_array($this->CSS)){
	foreach($this->CSS as $cs_path){
		$cs->registerCssFile(Yii::app()->request->baseUrl . $cs_path);
	}
}