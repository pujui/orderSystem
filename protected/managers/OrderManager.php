<?php
class OrderManager{

    /**
     * 訂單列表
     * @param unknown $pageVO
     * @return OrderListPage
     */
    public function findOrderList($pageVO){
        $orderDAO = new OrderDAO();
        $result = $orderDAO->findOrderList($pageVO, 'TOTAL');
        $pageVO->total = empty($result)? 0: $result['count'];
        $pageVO->price = empty($result)? 0: $result['price'];
        $pageVO->createStartRange();
    
        $list = $orderDAO->findOrderList($pageVO, 'PAGE');
        $orderListPage = new OrderListPage;
        $orderListPage->pageVO = $pageVO;
        foreach ($list as $row){
            $row['details'] = $orderDAO->findDetail($row['orderId']);
            $orderVO = new OrderVO;
            $orderVO->setData($row);
            $orderListPage->details[] = $orderVO;
        }
        return $orderListPage;
    }
    
    /**
     * 新增訂單
     * @param unknown itemM     組合名
     * @param unknown itemPrice 價錢
     * @param unknown itemCount 購買數
     * @param unknown itemTotal 小計
     * @param unknown itemId    購買品項
     * @param unknown itemName  購買品項名稱
     */
    public function add($userVO, $data){
        $insert = [];
        $main = [
            'priceTotal' => 0,
            'creater'    => $userVO->userId
        ];
        foreach ($data['itemM'] as $key=>$value){
            $insert[] = [
                'menuId'    => $data['itemId'][$key],
                'price'     => $data['itemPrice'][$key],
                'itemCount' => $data['itemCount'][$key],
                'itemTotal' => $data['itemTotal'][$key],
                'memo' => $value,
            ];
            if($data['itemTotal'][$key] != $data['itemCount'][$key]*$data['itemPrice'][$key]){
                throw new OrderException(OrderException::ERR_OTHER);
            }
            $main['priceTotal'] += $data['itemTotal'][$key];
        }
        $orderDAO = new OrderDAO();
        $result = $orderDAO->add($main, $insert);
        if($result === false){
            throw new OrderException(OrderException::ERR_CREATE_ORDER);
        }
    }
    
}