<?php
class LineBotController extends FrameController{

    const MESSAGE_FIRST_SETTING = '請選擇你要使用系統方式:';
    
    const TOKEN = 'Authorization: Bearer +EcHH6lvAf/A5uW512v+RANnVU/+tRQaMJkS4KkxtuAnmUjtwz9aiIx2V/5rYeH3k7vjxh4t549kvUUvZfSQc1KVDobOM7izPQgzMWqym+7NXH9xvcym0DlriDnGWZQ5Fy5XFA1m/I1WajRZHx9xyQdB04t89/1O/w1cDnyilFU=';

    protected $keyword = [
    ];
    
    public function actionPush(){
        $header = [
            'Content-Type: application/json',
            self::TOKEN
        ];
        $postData = [
            'to' => 'Uedb3beba41a0db8cafc690d13a77e561',
            'messages' => [
                [
                    'type' => 'text',
                    'text' => 'hello1',
                ]
            ]
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/push');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function actionProfile($userId = '', $r = ''){
        $header = [
            'Content-Type: application/json',
            self::TOKEN
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/profile/'.$userId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        if($r === '1') return json_decode($result, true);
        echo $result;
    }
    
    public function actionHook(){
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response = [ 'result' => false ];
        if(empty($input) || !is_array($input)){
            $this->exitHook($response);
        }
        $response = [ 'replyToken' => '', 'message'   => [ 'type' => 'text', 'text' => '' ] ];
        $userId = $message = '';
        $userData = [];
        $lineBotDAO = new LineBotDAO;
        foreach ($input as $key=>&$data){
            if($key == 0){
                $userId = $data['source']['userId'];
                $message = $data['message']['text'];
                $response['replyToken'] = $data['replyToken'];
                $userData = $this->actionProfile($userId, '1');
            }
            $data['displayName'] = $userData['displayName'];
            $lineBotDAO->addAccessLog($data);
        }
        $command = explode(' ', $message);
        $this->setUserMode($userId, $command[0], $command[1], $response);
        $this->exitHook($response);
    }
    
    private function setUserMode($userId, $command, $message, &$response){
        $userInfo = $this->findUser($userId);
        if(empty($userInfo)){
            $response['message']['text'] = self::MESSAGE_FIRST_SETTING;
        }
        $lineBotDAO->setUser($user);
    }

    private function exitHook($response){
        echo json_encode($response);
        exit;
    }
}