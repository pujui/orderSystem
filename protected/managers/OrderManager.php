<?php
class OrderManager{

    public function findOrderList($pageVO){
        $orderDAO = new OrderDAO();
        $pageVO->total = $orderDAO->findOrderList($pageVO, 'TOTAL');
        $pageVO->createStartRange();
    
        $list = $orderDAO->findOrderList($pageVO, 'PAGE');
        $orderListPage = new OrderListPage;
        $orderListPage->pageVO = $pageVO;
        foreach ($list as $row){
            $orderVO = new OrderVO;
            $orderVO->setData($row);
            $orderListPage->details[] = $orderVO;
        }
        return $orderListPage;
    }
    
}