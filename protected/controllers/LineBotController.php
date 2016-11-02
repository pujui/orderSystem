<?php
class LineBotController extends FrameController{

    public function __construct(){
    }
    
    public function actionHook(){
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response = [ 'result' => false ];
        if(empty($input) || !is_array($input)){
            $this->exitHook($response);
        }
        $response = [
            'replyToken' => '',
            'messages'   => [
                'type' => 'text',
                'text' => ''
            ]
        ];
        $lineBotDAO = new LineBotDAO;
        foreach ($input as $key=>&$data){
            if($key == 0){
                $response['message']['text'] = $data['source']['userId'].':'.$data['message']['text'];
            }
            $lineBotDAO->addAccessLog($data);
        }
        $this->exitHook($response);
    }
    
    private function exitHook($response){
        echo json_encode($response);
        exit;
    }
}