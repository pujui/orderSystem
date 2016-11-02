<?php
class LineBotDAO extends BaseDAO{

    public function addAccessLog($data){
        $sql = "INSERT INTO LineBot.access_log
                    (replyToken
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
                    (:replyToken
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
            ':replyToken'   => $data['replyToken'],
            ':type'         => $data['type'],
            ':timestamp'    => date('Y-m-d H:i:s', $data['timestamp']),
            ':sourceType'   => $data['source']['type'],
            ':userId'       => $data['source']['userId'],
            ':messageId'    => $data['message']['id'],
            ':messageType'  => $data['message']['type'],
            ':messageText'  => $data['message']['text'],
            ':log'          => json_encode($data),
        ));
    }

}