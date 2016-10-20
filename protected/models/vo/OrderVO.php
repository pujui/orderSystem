<?php
class OrderVO{
    
    public $orderId;
    public $todayOrderNo;
    public $creater;
    public $priceTotal;
    public $status;
    public $createTime;
    public $updateTime;

    public $details;
    
    public function setData($row){
        if(empty($row) || !is_array($row)){
            return false;
        }
        $this->orderId = $row['orderId'];
        $this->todayOrderNo = $row['todayOrderNo'];
        $this->creater = $row['creater'];
        $this->status = $row['status'];
        $this->priceTotal = $row['priceTotal'];
        $this->createTime = $row['createTime'];
        $this->updateTime = $row['updateTime'];
        
        $this->details = $row['details'];
    }

}
