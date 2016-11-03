<?php
class LineBotDAO extends BaseDAO{

    public function addAccessLog($data){
        $sql = "INSERT INTO LineBot.access_log
                    (displayName
                    , replyToken
                    , `type`
                    , `timestamp`
                    , sourceType
                    , userId
                    , messageId
                    , messageType
                    , messageText
                    , createTime
                    , `log`
                    )
                VALUES
                    (:displayName
                    , :replyToken
                    , :type
                    , :timestamp
                    , :sourceType
                    , :userId
                    , :messageId
                    , :messageType
                    , :messageText
                    , NOW()
                    , :log ) ";
        $this->bindQuery($sql, array(
            ':displayName'  => (string)$data['displayName'],
            ':replyToken'   => (string)$data['replyToken'],
            ':type'         => (string)$data['type'],
            ':timestamp'    => (string)$data['timestamp'],
            ':sourceType'   => (string)$data['source']['type'],
            ':userId'       => (string)$data['source'][$data['source']['type'].'Id'],
            ':messageId'    => (string)$data['message']['id'],
            ':messageType'  => (string)$data['message']['type'],
            ':messageText'  => (string)$data['message']['text'],
            ':log'          => json_encode($data),
        ));
    }

    public function findUser($userId){
        return $this->getCommand(
                    "SELECT * FROM LineBot.user WHERE userId=:userId LIMIT 1",
                    [':userId' => (string)$userId]
                )
                ->queryRow();
    }

    public function findRoom($roomId){
        return $this->getCommand(
                    "SELECT * FROM LineBot.room WHERE roomId=:roomId LIMIT 1",
                    [':roomId' => (string)$roomId]
                )
                ->queryRow();
    }

    public function findRoomList($roomId){
        return $this->getCommand(
                    "SELECT * FROM LineBot.room_list WHERE roomId=:roomId",
                    [':roomId' => (string)$roomId]
                )
                ->queryAll();
    }
    
    public function setUser($user){
        $sql = "INSERT INTO LineBot.user (userId, `mode`, `createTime`) VALUES (:userId, :mode, NOW())
                ON DUPLICATE KEY UPDATE `mode`=:mode, updateTime=NOW() ";
        $this->bindQuery($sql, [
            ':userId'   => (string)$user['userId'],
            ':mode'     => (string)$user['mode']
        ]);
    }
    
    public function setRoom($roomId, $status){
        $sql = "INSERT INTO LineBot.room (roomId, `status`, `createTime`) VALUES (:roomId, :status, NOW())
                ON DUPLICATE KEY UPDATE `status`=:status, updateTime=NOW() ";
        $this->bindQuery($sql, [
            ':roomId'   => (string)$roomId,
            ':status'   => (string)$status,
        ]);
    }
}