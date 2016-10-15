<?php
class TemplateLib{
	
	public $FRAME_DATA = array();
		
	public function __construct(){
		$this->FRAME_DATA = array(
								'UserLib' => new UserLib
							);
	}
	
	public function layout($yii, $page, $data = array()){
	
		$yii->layout='//layouts/pay-system/frame';
		
		$yii->FRAME_DATA = array(
			'UserLib' => new UserLib
		);
		
		$this->FRAME_DATA = array_merge($this->FRAME_DATA, $yii->FRAME_DATA);
		
		$this->FRAME_DATA = array_merge($this->FRAME_DATA, $data);
		
		$yii->render($page, $this->FRAME_DATA);
	}
	
	
	public function getOptions(){
		$options = array(
						1	=>	array(
									'power' => true,
									'name' => '帳戶明細管理',
									'url' => '/detail/'
								)
					);
		return $options;
	}
	
}

global $js_var_dump;

function JsVarAction($name, $value){
	global $js_var_dump;
	if(empty($js_var_dump)){
		$js_var_dump = array();
	}
	$js_var_dump[$name] = $value;
}

function JsVarDump(){
	global $js_var_dump;
	if(empty($js_var_dump)){
		return;
	}
	echo "<script type=\"text/javascript\">\n";
	foreach ($js_var_dump as $key=>$name){
		echo sprintf("var %s = %s;", $key, json_encode($name));
	}
	echo "\n</script>\n";
}

