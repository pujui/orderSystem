<?php
class MenuDAO extends BaseDAO{

    public function findMenuClass(){
        $WHERE = "WHERE
                    m.isCancel!=-1 ";
        $FROM = "FROM
                    ordersystem.menu AS m
                ";
        return $this->getCommand(
                    "SELECT m.firstClass "
                    .$FROM
                    .$WHERE
                    ." GROUP BY m.firstClass " 
                )
                ->queryAll();
    }
    
    public function findMenuList($pageVO, $action = 'PAGE'){
        $FROM = "FROM
                    ordersystem.menu AS m
                ";
        $WHERE = "WHERE
                    m.isCancel!=-1 ";
        if($action == 'SHOW'){
            $WHERE = "WHERE
                        m.isCancel=0 ";
            return $this->getCommand(
                    "SELECT m.* "
                    .$FROM
                    .$WHERE
                    ."ORDER BY m.firstClass DESC " 
            )
            ->queryAll();
        }else if($action == 'PAGE'){
            return $this->getCommand(
                    "SELECT m.* "
                    .$FROM
                    .$WHERE
                    ."ORDER BY m.firstClass DESC "
                    ."LIMIT :start, :limit " ,
                    array(
                        ':start' => $pageVO->start,
                        ':limit' => $pageVO->limit
                    )
            )
            ->queryAll();
        }else{
            $row = $this->getCommand(
                                "SELECT COUNT(m.menuId) AS count "
                                .$FROM
                                .$WHERE
                            )
                            ->queryRow();
            return (empty($row))? 0: $row['count'];
        }
    }

    /**
     * 建立帳號
     */
    public function add($insert){
        $sql = "INSERT INTO ordersystem.menu
                    (name, firstClass, isCancel, updateTime, createTime
                    , className1, classPrice1
                    , className2, classPrice2
                    , className3, classPrice3
                    , className4, classPrice4
                    , className5, classPrice5
                    , className6, classPrice6
                    , className7, classPrice7
                    , className8, classPrice8
                    , className9, classPrice9
                    , className10, classPrice10) 
                VALUES
                    (:name, :firstClass, :isCancel, NOW(), NOW()
                    , :className1, :classPrice1
                    , :className2, :classPrice2
                    , :className3, :classPrice3
                    , :className4, :classPrice4
                    , :className5, :classPrice5
                    , :className6, :classPrice6
                    , :className7, :classPrice7
                    , :className8, :classPrice8
                    , :className9, :classPrice9
                    , :className10, :classPrice10)";
        $this->bindQuery($sql, array(
            ':name'         => $insert['name'],
            ':firstClass'   => $insert['firstClass'],
            ':isCancel'     => $insert['isCancel'],
            ':className1'   => $insert['className1'],
            ':className2'   => $insert['className2'],
            ':className3'   => $insert['className3'],
            ':className4'   => $insert['className4'],
            ':className5'   => $insert['className5'],
            ':className6'   => $insert['className6'],
            ':className7'   => $insert['className7'],
            ':className8'   => $insert['className8'],
            ':className9'   => $insert['className9'],
            ':className10'  => $insert['className10'],
            ':classPrice1'   => $insert['classPrice1'],
            ':classPrice2'   => $insert['classPrice2'],
            ':classPrice3'   => $insert['classPrice3'],
            ':classPrice4'   => $insert['classPrice4'],
            ':classPrice5'   => $insert['classPrice5'],
            ':classPrice6'   => $insert['classPrice6'],
            ':classPrice7'   => $insert['classPrice7'],
            ':classPrice8'   => $insert['classPrice8'],
            ':classPrice9'   => $insert['classPrice9'],
            ':classPrice10'  => $insert['classPrice10'],
        ));
    }

    public function edit($insert){
        $sql = "UPDATE ordersystem.menu 
                SET
                    name=:name
                    , firstClass=:firstClass
                    , isCancel=:isCancel
                    , updatetime=NOW()
                    , className1=:className1
                    , classPrice1=:classPrice1
                    , className2=:className2
                    , classPrice2=:classPrice2
                    , className3=:className3
                    , classPrice3=:classPrice3
                    , className4=:className4
                    , classPrice4=:classPrice4
                    , className5=:className5
                    , classPrice5=:classPrice5
                    , className6=:className6
                    , classPrice6=:classPrice6
                    , className7=:className7
                    , classPrice7=:classPrice7
                    , className8=:className8
                    , classPrice8=:classPrice8
                    , className9=:className9
                    , classPrice9=:classPrice9
                    , className10=:className10
                    , classPrice10=:classPrice10
                WHERE menuId=:menuId";
        $this->bindQuery($sql, array(
            ':name'         => $insert['name'],
            ':firstClass'   => $insert['firstClass'],
            ':isCancel'     => $insert['isCancel'],
            ':menuId'       => $insert['menuId'],
            ':className1'   => $insert['className1'],
            ':className2'   => $insert['className2'],
            ':className3'   => $insert['className3'],
            ':className4'   => $insert['className4'],
            ':className5'   => $insert['className5'],
            ':className6'   => $insert['className6'],
            ':className7'   => $insert['className7'],
            ':className8'   => $insert['className8'],
            ':className9'   => $insert['className9'],
            ':className10'  => $insert['className10'],
            ':classPrice1'   => $insert['classPrice1'],
            ':classPrice2'   => $insert['classPrice2'],
            ':classPrice3'   => $insert['classPrice3'],
            ':classPrice4'   => $insert['classPrice4'],
            ':classPrice5'   => $insert['classPrice5'],
            ':classPrice6'   => $insert['classPrice6'],
            ':classPrice7'   => $insert['classPrice7'],
            ':classPrice8'   => $insert['classPrice8'],
            ':classPrice9'   => $insert['classPrice9'],
            ':classPrice10'  => $insert['classPrice10'],
        ));
    }

    public function findMenuId($menuId){
        $sql = "SELECT *
                FROM ordersystem.menu
                WHERE menuId=:menuId ";
        return $this->queryRow(
                $sql,
                array(':menuId' => $menuId)
        );
    }

    public function findExtraMenu(){
        $sql = "SELECT *
                FROM ordersystem.extramenu
                ORDER BY extraId ";
        return $this->queryAll($sql);
    }

    public function editExtraMenu($insert, $option = ''){
        $bind = [
            ':extraId' => $insert[':extraId'],
            ':name' => $insert[':name']
        ];
        $set = '';
        if($option == 'extra'){
            $bind[':price'] = $insert[':price'];
            $set = ',price=:price';
        }
        $sql = "UPDATE ordersystem.extramenu
                SET name=:name {$set}
                WHERE extraId=:extraId";
        $this->bindQuery($sql, $bind);
    }
}
