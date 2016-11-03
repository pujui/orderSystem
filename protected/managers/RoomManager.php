<?php
class RoomManager{

    const ROOM_OPEN = 'OPEN';
    const MESSAGE_OPEN = "遊戲房間已開啟\n加入遊戲請輸入遊戲代碼:\n%s";
    const MESSAGE_WAITE_START = "遊戲房間狀態: OPEN, 玩家人數: %d\n加入遊戲請輸入遊戲代碼:\n%s\n開始遊戲請輸入: start";
    const MESSAGE_START = "遊戲房間狀態: START, 玩家人數: %d\n已無法加入遊戲只能觀看";

    public function action($roomId, $message, &$response){
        $lineBotDAO = new LineBotDAO;
        $roomId = $lineBotDAO->findRoom($roomId);
        if(empty($userInfo)){
            $lineBotDAO->setRoom($roomId, self::ROOM_OPEN);
            $response['message']['text'] = sprintf(self::MESSAGE_OPEN, $roomId);
        }else{
            $list = $lineBotDAO->findRoomList($roomId);
            $response['message']['text'] = sprintf(self::MESSAGE_WAITE_START, count($list), $roomId);
        }
    }
    
}