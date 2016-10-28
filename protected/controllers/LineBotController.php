<?php
class LineBotController extends FrameController{

    public function __construct(){
    }
    
    public function actionHook(){
        $file = fopen(dirname(__FILE__)."/../runtime/line.log","a+");
        fwrite($file, sprintf('post:%s'.PHP_EOL, json_encode($_POST)));
        fwrite($file, sprintf('get:%s'.PHP_EOL, json_encode($_GET)));
        fwrite($file, sprintf('phpinput:%s'.PHP_EOL, file_get_contents("php://input")));
        fclose($file);
        echo 'ok';
    }
}