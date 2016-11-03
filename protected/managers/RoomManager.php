<?php
class RoomManager{

    const ROOM_OPEN = 'OPEN';
    const ROOM_ROLE_JOIN = 'JOIN';
    const MESSAGE_OPEN = "遊戲房間已開啟\n加入遊戲請輸入遊戲代碼:\njoin %s";
    const MESSAGE_WAITE_START = "遊戲房間狀態: OPEN, 玩家人數: %d\n加入遊戲請輸入遊戲代碼:\njoin %s\n開始遊戲請輸入: start";
    const MESSAGE_START = "遊戲房間狀態: START, 玩家人數: %d\n已無法加入遊戲只能觀看";
    const MESSAGE_NOT_EXISTS = "遊戲房間不存在";

    public function action($roomId, $message, &$response){
        $lineBotDAO = new LineBotDAO;
        $roomInfo = $lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            $lineBotDAO->setRoom($roomId, self::ROOM_OPEN);
            $response['message']['text'] = sprintf(self::MESSAGE_OPEN, $roomId);
        }else{
            $list = $lineBotDAO->findRoomList($roomId);
            $response['message']['text'] = sprintf(self::MESSAGE_WAITE_START, count($list), $roomId);
        }
    }
    
    public function join($userId, $command, &$response){
        $lineBotDAO = new LineBotDAO;
        $roomId = $command[1];
        
        $roomInfo = $lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            $response['message']['text'] = self::MESSAGE_NOT_EXISTS;
            return;
        }
        $lineBotDAO->setRoomList($roomId, $userId, self::ROOM_ROLE_JOIN);
    }
}