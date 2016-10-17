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
    
}