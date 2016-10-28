<?php
require_once dirname(__FILE__).'/../framework/LINEBot.php';
require_once dirname(__FILE__).'/../framework/LINEBot/Constant/Meta.php';
require_once dirname(__FILE__).'/../framework/LINEBot/Constant/MessageType.php';
require_once dirname(__FILE__).'/../framework/LINEBot/MessageBuilder.php';
require_once dirname(__FILE__).'/../framework/LINEBot/MessageBuilder/TextMessageBuilder.php';
require_once dirname(__FILE__).'/../framework/LINEBot/HTTPClient.php';
require_once dirname(__FILE__).'/../framework/LINEBot/HTTPClient/Curl.php';
require_once dirname(__FILE__).'/../framework/LINEBot/HTTPClient/CurlHTTPClient.php';
require_once dirname(__FILE__).'/../framework/LINEBot/Exception/CurlExecutionException.php';


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
    
    public function actionPush(){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ql6H42WjDDCViHshU89XzBTG9k+LiAtuHyE9j+2Kwml3HlU6iymtzdlsz41aBglak7vjxh4t549kvUUvZfSQc1KVDobOM7izPQgzMWqym+4TR2REoyika4JWM5oZSBQf6pKBwtG7R81GKQ6mem1LCQdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '99b1dea83b05a4271096a91025e7765c']);
        
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
        $response = $bot->pushMessage('<to>', $textMessageBuilder);
        
        echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }
}