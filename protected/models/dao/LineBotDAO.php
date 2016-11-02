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
            ':displayName'  => $data['displayName'],
            ':replyToken'   => $data['replyToken'],
            ':type'         => $data['type'],
            ':timestamp'    => $data['timestamp'],
            ':sourceType'   => $data['source']['type'],
            ':userId'       => $data['source']['userId'],
            ':messageId'    => $data['message']['id'],
            ':messageType'  => $data['message']['type'],
            ':messageText'  => $data['message']['text'],
            ':log'          => json_encode($data),
        ));
    }

    public function findUser($userId){
        return $this->getCommand(
                    "SELECT * FROM LineBot.user WHERE userId=:userId LIMIT 1",
                    [':userId' => $userId]
                )
                ->queryRow();
    }
    
    public function setUser($user){
        $sql = "INSERT INTO LineBot.user (userId, `mode`, `createTime`)
                ON DUPLICATE KEY UPDATE `mode`=:mode, updateTime=NOW() ";
        $this->bindQuery($sql, array(
            ':replyToken'   => $user['userId'],
            ':type'         => $user['mode']
        ));
    }
}