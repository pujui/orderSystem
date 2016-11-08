<?php
class RoomManager{
    
    protected $MESSAGES = [
        'OPEN'                  => "遊戲房間已開啟\n1.請加入我(BOT)為好友\n2.並傳送房間代碼至BOT加入遊戲",
        'WAITE_STATUS'          => "遊戲房間狀態: %s, 玩家人數: %d\n開始遊戲請在此房間輸入/start",
        'JOIN'                  => "加入遊戲請輸入以下代碼傳送至我(BOT)",
        'JOIN_COMMAND'          => "/join %s",
        'START_STATUS'          => "遊戲房間狀態: %s, 玩家人數: %d\n遊戲已開始已無法加入遊戲只能觀看",
        'JOIN_ROOM_NOT_EXIST'   => "遊戲房間不存在, 請確認是否複製錯誤",
        'JOIN_ROOM_SUCCESS'     => "已加入遊戲",
    ];

    protected $ROOM_STATUS = [
        'CREATE'    => 'CREATE',
        'OPEN'      => 'OPEN',
        'START'     => 'START',
    ];

    protected $ROLE_STATUS = [
        'NORMAL'  => 'NORMAL',
        'DEAD'    => 'DEAD',
        'HELP'    => 'HELP',
        'ARREST'  => 'ARREST',
        'LEAVE'   => 'LEAVE'
    ];

    protected $ROLES = [
        'JOIN'      => 'JOIN',
        'KILLER'    => 'KILLER',
        'HELPER'    => 'HELPER',
        'POLICE'    => 'POLICE',
        'VILLAGER'  => 'VILLAGER'
    ];

    const ROOM_EVENT_STOP = 'STOP';
    const ROOM_EVENT_START = 'START';
    const MESSAGE_OPEN = "遊戲房間已開啟\n-------------\n請加入BOT為好友並傳送房間代碼加入遊戲\n\n";
    const MESSAGE_WAITE_START = "遊戲房間狀態: %s, 玩家人數: %d\n加入房間請輸入代碼傳送至BOT:\n/join %s\n-------------\n開始遊戲請在GAME ROOM輸入\"/start\"\n-------------\n";
    const MESSAGE_START = "遊戲房間狀態:%s,玩家人數:%d\n已無法加入遊戲只能觀看\n\n";
    const MESSAGE_NOT_EXISTS = "遊戲房間不存在\n";
    
    const MESSAGE_START_PEOPLE_LIMIT = "遊戲人數最少四人\n";
    const MESSAGE_START_ALREADY = "遊戲已準備好,腳色分配完畢\n";

    const MESSAGE_LEAVE_NOT_EXIST = "你目前無在任何遊戲內\n";
    const MESSAGE_LEAVE_SUCCESS = "你已離開遊戲\n";
    const MESSAGE_JOIN_SUCCESS = "已加入遊戲\n";
    
    const ROOM_ROLE_JOIN = 'JOIN';
    const ROOM_ROLE_STATUS_NORAML = 'NORMAL';
    const ROOM_ROLE_STATUS_LEAVE = 'LEAVE';
    const ROOM_ROLE_STATUS_DEAD = 'DEAD';
    
    const MESSAGE_KILL_NOT_EXIST = "角色不存在\n";
    const MESSAGE_KILL_ALREADY_DEAD = " 角色已死亡\n";
    const MESSAGE_KILL_ALREADY_LEAVE = " 角色已逃亡\n";
    const MESSAGE_KILL_SUCCESS = " 角色已殺死\n";
    
    public $parent = null;
    
    private $lineBotDAO;
    private $role = [
        ['role' => 'KILLER', 'roleName' => '殺手'],
        ['role' => 'HELPER', 'roleName' => '救援'],
        ['role' => 'POLICE', 'roleName' => '警察'],
        ['role' => 'VILLAGER', 'roleName' => '村民']
    ];
    private $roleName = [
        'KILLER'    => "[殺手]\n可以殺死任何對象\n/kill [player number] \nexample: /kill 1",
        'HELPER'    => "[救援]\n可以再每回合隨意救活被殺手殺死對象(當然也可以救活自己)\n/help [player number] \nexample: /help 1",
        'POLICE'    => "[警察]\n當有人死亡後會被公布出來, 被公布後可以被殺手殺死之前不行",
        'VILLAGER'  => "[村民]\n只可以投票誰是兇手的羔羊"
    ];
    private $roleStatus = [
        'NORMAL'  => 'Live',
        'DEAD'    => 'Dead',
        'HELP'    => 'Live-此回合被拯救',
        'ARREST'  => 'Live',
        'LEAVE'   => 'Leave'
    ];
    private $events = [
        'STOP'     => '已動作',
        'START'    => '未動作'
    ];

    public function __construct(){
        $this->lineBotDAO = new LineBotDAO;
    }
    
    public function role($roomId, $message, &$response){
        $response['message']['text'] = implode(PHP_EOL.PHP_EOL, $this->roleName);;
    }

    /**
     * Open the room by room
     * 1. Check the room is exist.
     *  1-1 If the room not exist then create this room.
     *  1-2 else return room status.
     * @param unknown $roomId
     * @param unknown $message
     * @param unknown $response
     */
    public function open($roomId, $message, &$response){
        $message = [ 'type' => 'text', 'text' => '' ];
        // If the room not exist then create this room.
        $roomInfo = $this->lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            // Create this room.
            $this->lineBotDAO->setRoom($roomId, $this->ROOM_STATUS['OPEN']);
            // Set room message
            $this->setRoomStatus($roomId, $this->ROOM_STATUS['CREATE'], $response);
        // else set room status message
        }else{
            $this->setRoomStatus($roomId, $roomInfo['status'], $response);
        }
    }

    /**
     * Join the room by user
     * @param unknown $userId
     * @param unknown $command
     * @param unknown $response
     */
    public function join($userId, $command, &$response){
        $message = [ 'type' => 'text', 'text' => '' ];
        $roomId = $command[1];
        $roomInfo = $this->lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            $message['text'] = $this->MESSAGES['JOIN_ROOM_NOT_EXIST'];
            $response['messages'][] = $message;
        }else if($roomInfo['status'] == $this->ROOM_STATUS['OPEN']){
            $pushMessages = $response;
            $this->lineBotDAO->setRoomList($roomId, $userId, $response['displayName'], $this->ROLE_STATUS['NORMAL'], $this->ROLE_STATUS['JOIN']);
            $message['text'] = $this->MESSAGES['JOIN_ROOM_SUCCESS'];
            $response['messages'][] = $message;
            $this->setRoomRoleStatus($roomId, $response);

            $message['text'] = $response['displayName'].$this->MESSAGES['JOIN_ROOM_SUCCESS'];
            $pushMessages['messages'][] = $message;
            $this->setRoomStatus($roomId, $roomInfo['status'], $response);
            $this->parent->actionPushMessages($roomId, $pushMessages['messages']);
        }else if($roomInfo['status'] == $this->ROOM_STATUS['START']){
            $this->setRoomStatus($roomId, $roomInfo['status'], $response);
        }
    }

    public function start($roomId, $message, &$response){
        $roomInfo = $this->lineBotDAO->findRoom($roomId);
        if(empty($roomInfo)){
            $response['message']['text'] = self::MESSAGE_NOT_EXISTS;
        }else if($roomInfo['status'] == $this->ROOM_STATUS['OPEN']){
            $list = $this->lineBotDAO->findRoomList($roomId);
            $totalPeople = count($list);
            if($totalPeople < 4){
                $response['message']['text'] = self::MESSAGE_START_PEOPLE_LIMIT;
            }else{
                // Change status for this room.
                $this->lineBotDAO->setRoom($roomId, $this->ROOM_STATUS['START']);
                $randomList = $list;
                $setList = [];
                foreach ($list as $row){
                    $setList[$row['id']] = $row;
                }
                shuffle($randomList);
                // Protect limit with role
                $checkProtectedNumber = 1;
                foreach ($randomList as $key=>$user){
                    if($checkProtectedNumber > 0){
                        $r_k = ($key+1)%4;
                        $setList[$user['id']]['role'] = $this->role[$r_k]['role'];
                        $setList[$user['id']]['roleName'] = $this->roleName[$this->role[$r_k]['role']];
                        if($r_k == 0) $checkProtectedNumber--;
                    }else{
                        $r_k = (rand(0, 999)*$user['id'])%4;
                        $setList[$user['id']]['role'] = $this->role[$r_k]['role'];
                        $setList[$user['id']]['roleName'] = $this->roleName[$this->role[$r_k]['role']];
                    }
                    $this->lineBotDAO->updateRoomList($roomId, $user['userId'], $setList[$user['id']]['role'], '', self::ROOM_EVENT_START);
                }
                $response['message']['text'] = self::MESSAGE_START_ALREADY;
                $response['message']['text'] .= $this->getRoomRoleStatus($roomId);
                foreach ($setList as $user){
                    $this->parent->actionPush($user['userId'], '您角色為 - '.$user['roleName']);
                }
            }
        }
    }

    public function leave($userId, $message, &$response){
        $userLiveRoom = $this->lineBotDAO->findRoomUserIsLive($userId);
        if(empty($userLiveRoom)){
            $response['message']['text'] = self::MESSAGE_LEAVE_NOT_EXIST;
        }else{
            $this->lineBotDAO->updateRoomList($userLiveRoom['roomId'], $userId, '', self::ROOM_ROLE_STATUS_LEAVE);
            $this->parent->actionPush(
                        $userLiveRoom['roomId'], 
                        $userLiveRoom['displayName'].' 離開遊戲'.PHP_EOL.$this->getRoomRoleStatus($userLiveRoom['roomId'])
                    );
            $response['message']['text'] = self::MESSAGE_LEAVE_SUCCESS;
        }
    }

    public function kill($userId, $command, &$response){
        $userLiveRoom = $this->lineBotDAO->findRoomUserIsLive($userId);
        if(empty($userLiveRoom)){
            return $response['message']['text'] = self::MESSAGE_LEAVE_NOT_EXIST;
        }else if($userLiveRoom['roomStatus'] == $this->ROOM_STATUS['START']){
            $list = $this->lineBotDAO->findRoomList($userLiveRoom['roomId']);
            $totalPeople = count($list);
            if($command[1] < 1 || $command[1] > $totalPeople){
                return $response['message']['text'] = self::MESSAGE_KILL_NOT_EXIST;;
            }
            $setList = $target = [];
            $self = $userLiveRoom;
            foreach ($list as $key=>$row){
                if($key == $command[1]){
                    if($row['status'] == self::ROOM_ROLE_STATUS_LEAVE){
                        return $response['message']['text'] = $row['displayName'].self::MESSAGE_KILL_ALREADY_LEAVE;
                    }else if($row['status'] == self::ROOM_ROLE_STATUS_DEAD){
                        return $response['message']['text'] = $row['displayName'].self::MESSAGE_KILL_ALREADY_DEAD;
                    }
                    $target = $row;
                }
                $row['number'] = $key+1;
                $setList[$row['id']] = $row;
            }
            $this->lineBotDAO->updateRoomList($target['roomId'], $target['userId'], '', self::ROOM_ROLE_STATUS_DEAD);
            $this->lineBotDAO->updateRoomList($self['roomId'], $self['userId'], '', '', self::ROOM_EVENT_STOP);
            $response['message']['text'] = $target['displayName'].self::MESSAGE_KILL_SUCCESS;
        }
    }

    public function getRoomRoleStatus($roomId){
        $message = '';
        $list = $this->lineBotDAO->findRoomList($roomId);
        foreach ($list as $key=>$user){
            $message .= sprintf("Player %d - %s(%s) - %s".PHP_EOL, 
                            $key+1
                            , $user['displayName']
                            , $this->roleStatus[$user['status']]
                            , $this->events[$user['event']]
                        );
        }
        return $message;
    }

    public function setRoomRoleStatus($roomId, &$response){
        $message = [ 'type' => 'text', 'text' => '' ];
        $list = $this->lineBotDAO->findRoomList($roomId);
        foreach ($list as $key=>$user){
            $message['text'] .= sprintf("Player %d - %s(%s) - %s".PHP_EOL, 
                                    $key+1
                                    , $user['displayName']
                                    , $this->roleStatus[$user['status']]
                                    , $this->events[$user['event']]
                                );
        }
        $response['messages'][] = $message;
    }

    public function setRoomStatus($roomId, $status, &$response){
        $message = [ 'type' => 'text', 'text' => '' ];
        $list = $this->lineBotDAO->findRoomList($roomId);
        if($status == $this->ROOM_STATUS['CREATE']){
            $message['text'] = sprintf($this->MESSAGES['OPEN'], $status, count($list));
            $response['messages'][] = $message;
            $message['text'] = sprintf($this->MESSAGES['WAITE_STATUS'], $status, count($list))
                               .PHP_EOL .$this->MESSAGES['JOIN'];
            $response['messages'][] = $message;
            $message['text'] = sprintf($this->MESSAGES['JOIN_COMMAND'], $roomId);
            $response['messages'][] = $message;
        }else if($status == $this->ROOM_STATUS['OPEN']){
            $message['text'] = sprintf($this->MESSAGES['WAITE_STATUS'], $status, count($list))
                               .PHP_EOL .$this->MESSAGES['JOIN'];
            $response['messages'][] = $message;
            $message['text'] = sprintf($this->MESSAGES['JOIN_COMMAND'], $roomId);
            $response['messages'][] = $message;
        }else if($status == $this->ROOM_STATUS['START']){
            $message['text'] = sprintf($this->MESSAGES['START_STATUS'], $status, count($list));
            $response['messages'][] = $message;
        }
    }
    
    public function getRoomStatus($roomId, $status, $pass = false){
        $message = [ 'type' => 'text', 'text' => '' ];
        if($pass !== true && $status == $this->ROOM_STATUS['OPEN']){
            $list = [];
        }else{
            $list = $this->lineBotDAO->findRoomList($roomId);
        }
        if($status == $this->ROOM_STATUS['OPEN']){
            return sprintf($this->MESSAGES['WAITE_STATUS'], $status, count($list));
        }else if($status == $this->ROOM_STATUS['START']){
            return sprintf(self::MESSAGE_START, $status, count($list), $roomId);
        }
    }
}