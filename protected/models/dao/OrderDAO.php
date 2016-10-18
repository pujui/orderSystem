<?php
class OrderDAO extends BaseDAO{

    public function findOrderList($pageVO, $action = 'PAGE', $search = []){
        $FROM = "FROM
                    ordersystem.orderlist AS ol ";
        $WHERE = "WHERE
                    1 ";
        $bind = [];

        if($search['start'] != '' && $search['end'] != ''){
            $WHERE .= ' AND createTime<=:endDate AND createTime>=:startDate ';
            $bind[':startDate'] = $search['start'] . ' 00:00:00';
            $bind[':endDate'] = $search['end'] . ' 23:59:59';
        }
        if($search['status'] == '1'){
            $WHERE .= ' AND status=:status ';
            $bind[':status'] = 0;
        }else if ($search['status'] == '2'){
            $WHERE .= ' AND status=:status ';
            $bind[':status'] = 1;
        }
    
        if($action == 'PAGE'){
            $bind[':start'] = $pageVO->start;
            $bind[':limit'] = $pageVO->limit;
            return $this->getCommand(
                    "SELECT ol.* "
                    .$FROM
                    .$WHERE
                    ."ORDER BY ol.orderId DESC "
                    ."LIMIT :start, :limit " ,
                    $bind
            )
            ->queryAll();
        }else{
            $row = $this->getCommand(
                        "SELECT COUNT(ol.orderId) AS count, SUM(ol.priceTotal) price "
                        .$FROM
                        .$WHERE,
                        $bind
                    )
            ->queryRow();
            return (empty($row))? []: $row;
        }
    }

    public function findDetail($orderId){
        $FROM = "FROM
                    ordersystem.orderdetail AS od ";
        $WHERE = "WHERE
                    od.orderId=:orderId ";
        return $this->getCommand(
                    "SELECT od.* "
                    .$FROM
                    .$WHERE
                    ."ORDER BY od.memo " ,
                    array(
                        ':orderId' => $orderId
                    )
                )
                ->queryAll();
    }

    public function add($main, $insert){
        $transaction = $this->db->beginTransaction();
        try
        {
            $count = $this->countOrderForToday();
            $todayOrderNo = sprintf('%sO%04d', date('Ymd'), $count+1);
            $sql = "INSERT INTO ordersystem.orderlist
                        (creater, todayOrderNo, priceTotal, createtime)
                    VALUES
                        (:creater, :todayOrderNo, :priceTotal, NOW())";
            $this->bindQuery($sql, array(':todayOrderNo' => $todayOrderNo, ':creater' => $main['creater'], ':priceTotal' => $main['priceTotal']));
            
            $orderId = $this->db->getLastInsertID();
            
            $bind = [ ':orderId' => $orderId];
            $sql = 'INSERT INTO ordersystem.orderdetail (orderId, menuId, price, itemCount, itemTotal, createTime, memo) VALUES ';
            $sqlList = [];
            foreach ($insert as $key=>$row){
                $sqlList[] = " (:orderId, :menuId{$key}, :price{$key}, :itemCount{$key}, :itemTotal{$key}, NOW(), :memo{$key}) ";
                $bind[":menuId{$key}"] = $row['menuId'];
                $bind[":price{$key}"] = $row['price'];
                $bind[":itemCount{$key}"] = $row['itemCount'];
                $bind[":itemTotal{$key}"] = $row['itemTotal'];
                $bind[":memo{$key}"] = $row['memo'];
            }
            $this->bindQuery($sql . implode(',', $sqlList), $bind);
           $transaction->commit();
           return true;
        }
        catch(Exception $e)
        {
           $transaction->rollback();
           return false;
        }
    }

    public function countOrderForToday(){
        $sql = "SELECT COUNT(orderId) count
                FROM ordersystem.orderlist
                WHERE
                    createTime BETWEEN DATE_FORMAT(CURDATE(),'%Y-%m-%d 00:00:00') AND NOW()
                ";
        $row = $this->getCommand($sql)
                    ->queryRow();
        return (empty($row))? 0: $row['count'];
    }

    public function findDataForLastMonth(){
        $startMonth = date('Y-m-d H:i:s', strtotime(date('Y-m').'-01 00:00:00 -5 months'));
        $endMonth = date('Y-m-d H:i:s');
        $sql = "SELECT
                    DATE_FORMAT(`createTime`, '%Y-%m') AS ym,
                    SUM(priceTotal) AS price,
                    COUNT(orderId) AS count
                FROM ordersystem.orderlist
                WHERE
                    status=1
                    AND `createTime` BETWEEN :start AND :end
                GROUP BY DATE_FORMAT(`createTime`, '%Y-%m') ";
        $result = $this->getCommand(
                    $sql,
                    array(
                        ':start' => $startMonth,
                        ':end' => $endMonth
                    )
                )
                ->queryAll();
        $list = [];
        foreach ($result as $row){
            $list[$row['ym']] = $row;
        }
        krsort($list);
        return $list;
    }

    public function findDataForLastDay(){
        $startDay = date('Y-m-d H:i:s', strtotime(date('Y-m-d').' 00:00:00 -7 days'));
        $endDay = date('Y-m-d H:i:s');
        $sql = "SELECT
                    DATE_FORMAT(`createTime`, '%Y-%m-%d') AS ym,
                    SUM(priceTotal) AS price,
                    COUNT(orderId) AS count
                FROM ordersystem.orderlist
                WHERE
                    status=1
                    AND `createTime` BETWEEN :start AND :end
                GROUP BY DATE_FORMAT(`createTime`, '%Y-%m-%d') ";
        $result = $this->getCommand(
                    $sql,
                    array(
                        ':start' => $startDay,
                        ':end' => $endDay
                    )
                )
                ->queryAll();
        $list = [];
        foreach ($result as $row){
            $list[$row['ym']] = $row;
        }
        krsort($list);
        return $list;
    }

    public function updateStatus($orderId, $status = 0){
        $bind = array(':orderId' => $orderId, ':status' => $status);
        $sql = "UPDATE
                    ordersystem.orderlist
                SET
                    status=:status
                    , updatetime=NOW()
                WHERE orderId=:orderId AND status=0 ";
        $this->bindQuery($sql, $bind);
    }
}