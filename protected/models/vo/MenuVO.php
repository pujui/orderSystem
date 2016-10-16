<?php
class MenuVO{
    
    public $menuId;
    public $name;
    public $firstClass;
    public $secondClass;
    public $isCancel;
    public $createTime;
    public $updateTime;

    public $classPrice;
    
    public function setData($row){
        if(empty($row) || !is_array($row)){
            return false;
        }
        $this->menuId = $row['menuId'];
        $this->name = $row['name'];
        $this->firstClass = $row['firstClass'];
        $this->secondClass = $row['secondClass'];
        $this->isCancel = $row['isCancel'];
        $this->createTime = $row['createTime'];
        $this->updateTime = $row['updateTime'];
        for($i = 1; $i < 11; $i++){
            $this->classPrice[] = [$row['className'.$i], $row['classPrice'.$i]];
        }
    }
}