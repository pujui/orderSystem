<?php
class OrderDAO extends BaseDAO{

    public function findOrderList($pageVO, $action = 'PAGE'){
        $FROM = "FROM
                    ordersystem.orderlist AS ol ";
        $WHERE = "WHERE
                    1 ";
    
        if($action == 'PAGE'){
            return $this->getCommand(
                    "SELECT ol.* "
                    .$FROM
                    .$WHERE
                    ."ORDER BY ol.orderId DESC "
                    ."LIMIT :start, :limit " ,
                    array(
                        ':start' => $pageVO->start,
                        ':limit' => $pageVO->limit
                    )
            )
            ->queryAll();
        }else{
            $row = $this->getCommand(
                    "SELECT COUNT(ol.orderId) AS count "
                    .$FROM
                    .$WHERE
            )
            ->queryRow();
            return (empty($row))? 0: $row['count'];
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
            $sql = "INSERT INTO ordersystem.orderlist
                        (creater, priceTotal, createtime)
                    VALUES
                        (:creater, :priceTotal, NOW())";
            $this->bindQuery($sql, array(':creater' => $main['creater'], ':priceTotal' => $main['priceTotal']));
            
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
}