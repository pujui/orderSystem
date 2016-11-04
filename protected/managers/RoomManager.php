<?php
class RoomManager{
    const ROOM_STATUS_OPEN = 'OPEN';
    const ROOM_STATUS_START = 'START';
    const MESSAGE_OPEN = "遊戲房間已開啟\n-------------\n請加入BOT為好友並傳送房間代碼加入遊戲\n\n";
    const MESSAGE_WAITE_START = "遊戲房間狀態: %s, 玩家人數: %d\n加入房間請輸入代碼傳送至BOT:\n/join %s\n-------------\n開始遊戲請在GAME ROOM輸入\"/start\"\n-------------";
    const MESSAGE_START = "遊戲房間狀態:%s,玩家人數:%d\n已無法加入遊戲只能觀看\n\n";
    const MESSAGE_NOT_EXISTS = "遊戲房間不存在";
    
    const MESSAGE_START_PEOPLE_LIMIT = "遊戲人數最少四人\n";
    const MESSAGE_START_ALREADY = "遊戲已準備好,腳色分配完畢\n";

    const ROOM_ROLE_JOIN = 'JOIN';
    const ROOM_ROLE_STATUS = 'NORMAL';
    
    private $lineBotDAO;
    private $role = [
        ['role' => 'KILLER', 'roleName' => '殺手'],
        ['role' => 'HELPER', 'roleName' => '救援'],
        ['role' => 'POLICE', 'roleName' => '警察'],
        ['role' => 'VILLAGER', 'roleName' => '村民']
    ];
    private $roleName = [
        'KILLER'    => '殺手',
        'HELPER'    => '救援',
        'POLICE'    => '警察',
        'VILLAGER'  => '村民'
    ];
    private $roleStatus = [
        'NORMAL'  => '活著',
        'DEAD'    => '死亡',
        'HELP'    => '救助',
        'ARREST'  => '逮捕',
    ];

    public function __construct(){
        $this->lineBotDAO = new LineBotDAO;
    }

    /**
     * Open the room
     * @param unknown $roomId
     * @param unknown $message
     * @param unknown $response
     */
    public function open($roomId, $message, &$response){
        // If the room not exist then create this room.
        $roomInfo = $this->lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            // Create this room.
            $this->lineBotDAO->setRoom($roomId, self::ROOM_STATUS_OPEN);
            // Set room message
            $response['message']['text'] = self::MESSAGE_OPEN;
            $response['message']['text'] .= $this->getRoomStatus($roomId, self::ROOM_STATUS_OPEN);
        // else if the room status is "OPEN" then set room message
        }else if($roomInfo['status'] == self::ROOM_STATUS_OPEN){
            $response['message']['text'] = $this->getRoomStatus($roomId, $roomInfo['status'], true);
        // else if the roomk status is "START" then set room message
        }else if($roomInfo['status'] == self::ROOM_STATUS_START){
            $response['message']['text'] = $this->getRoomStatus($roomId, $roomInfo['status'], true);
        }
    }

    /**
     * Join the room
     * @param unknown $userId
     * @param unknown $command
     * @param unknown $response
     */
    public function join($userId, $command, &$response){
        $roomId = $command[1];
        $roomInfo = $this->lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            $response['message']['text'] = self::MESSAGE_NOT_EXISTS;
        }else if($roomInfo['status'] == self::ROOM_STATUS_OPEN){
            $this->lineBotDAO->setRoomList(
                            $roomId, 
                            $userId, 
                            $response['displayName'], 
                            self::ROOM_ROLE_STATUS,
                            self::ROOM_ROLE_JOIN
                        );
        }else if($roomInfo['status'] == self::ROOM_STATUS_START){
            $response['message']['text'] = $this->getRoomStatus($roomId, $roomInfo['status'], true);
        }
    }

    public function start($roomId, $message, &$response){
        $roomInfo = $this->lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            $response['message']['text'] = self::MESSAGE_NOT_EXISTS;
        }else if($roomInfo['status'] == self::ROOM_STATUS_OPEN){
            $list = $this->lineBotDAO->findRoomList($roomId);
            $totalPeople = count($list);
            if($totalPeople < 4){
                $response['message']['text'] = self::MESSAGE_START_PEOPLE_LIMIT;
            }else{
                // Change status for this room.
                $this->lineBotDAO->setRoom($roomId, self::ROOM_STATUS_START);
                $randomList = $list;
                $setList = [];
                foreach ($list as $row){
                    $setList[$row['id']] = $row;
                }
                shuffle($randomList);
                $checkProtectedNumber = 1;
                foreach ($randomList as $key=>$user){
                    if($checkProtectedNumber > 0){
                        $r_k = ($key+1)%4;
                        $setList[$user['id']]['role'] = $this->role[$r_k]['role'];
                        $setList[$user['id']]['roleName'] = $this->role[$r_k]['roleName'];
                        if($r_k == 0) $checkProtectedNumber--;
                    }else{
                        $r_k = (rand(0, 999)*$user['id'])%4;
                        $setList[$user['id']]['role'] = $this->role[$r_k]['role'];
                        $setList[$user['id']]['roleName'] = $this->role[$r_k]['roleName'];
                    }
                    $this->lineBotDAO->updateRoomList($roomId, $user['userId'], $setList[$user['id']]['role']);
                }
                $response['message']['text'] = self::MESSAGE_START_ALREADY;
                $response['message']['text'] .= $this->getRoomRoleStatus($roomId);
            }
        }
    }

    public function getRoomRoleStatus($roomId){
        $message = '';
        $list = $this->lineBotDAO->findRoomList($roomId);
        foreach ($list as $key=>$user){
            $message .= sprintf('No%d. %s - %s(%s)'.PHP_EOL, $key, $user['displayName'], $this->roleName[$user['role']], $this->roleStatus[$user['status']]);
        }
        return $message;
    }
    
    public function getRoomStatus($roomId, $status, $pass = false){
        if($pass !== true && $status == self::ROOM_STATUS_OPEN){
            $list = [];
        }else{
            $list = $this->lineBotDAO->findRoomList($roomId);
        }
        if($status == self::ROOM_STATUS_OPEN){
            return sprintf(self::MESSAGE_WAITE_START, $status, count($list), $roomId);
        }else if($status == self::ROOM_STATUS_START){
            return sprintf(self::MESSAGE_START, $status, count($list), $roomId);
        }
    }
}