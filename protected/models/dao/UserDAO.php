<?php
class UserDAO extends BaseDAO{

    public function findAccount($account){
        $sql = "SELECT * FROM orderSystem.user WHERE account=:account ";
        return $this->queryRow($sql, array(':account' => $account));
    }
    
    public function findUserIds($userIds){
        $sql = "SELECT * FROM member.user WHERE user_id IN ('%s') ";
        return $this->queryAll(sprintf($sql, implode("','", $userIds)));
    }

    /**
     * 找尋群組的使用者
     * @param integer $group_id
     */
    public function findUserList(){
        $sql = "SELECT *
                FROM orderSystem.user
                WHERE isActive!=-1
                ORDER BY userId ";
        return $this->getCommand($sql)->queryAll();
    }

    /**
     * 建立帳號
     */
    public function addUser($userVO){
        $sql = "INSERT INTO ordersystem.user
                    (account, name, password, privateKey, isActive, updateTime, createTime) 
                VALUES
                    (:account, :name, :password, :privateKey, :isActive, NOW(), NOW())";
        $this->bindQuery($sql, array(
            ':account'      => $userVO->account,
            ':name'         => $userVO->name,
            ':password'     => $userVO->password,
            ':privateKey'   => $userVO->privateKey,
            ':isActive'     => $userVO->isActive
        ));
    }
}