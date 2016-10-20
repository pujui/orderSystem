<?php
class DetailDAO extends BaseDAO{
    
    
    /**
     * 建立群組
     * @param integer $user_id
     * @param string $title
     */
    public function addGroup($user_id, $title){
        $sql = "INSERT INTO account.detail_group
                    (user_id, group_title, createtime) 
                VALUES
                    (:user_id, :title, NOW())";
        $this->bindQuery($sql, array(':user_id' => $user_id, ':title' => $title));
        $this->addGroupMember($this->db->getLastInsertID(), $user_id);
    }
    
    /**
     * 建立群組
     * @param integer $user_id
     * @param string $title
     */
    public function editGroup($user_id, $group_id, $title){
        $sql = "UPDATE account.detail_group 
                SET group_title=:title, updatetime=NOW() 
                WHERE group_id=:group_id AND user_id=:user_id";
        $this->bindQuery($sql, array(':user_id' => $user_id,':group_id' => $group_id, ':title' => $title));
    }
    
    public function delGroup($group_id){
        $sql = "UPDATE account.detail_group SET is_del=1, updatetime=NOW() WHERE group_id=:group_id ";
        $this->bindQuery($sql, array(':group_id' => $group_id));
    }
    
    /**
     * 建立群組成員
     * @param integer $group_id
     * @param integer $user_id
     */
    public function addGroupMember($group_id, $user_id){
        $sql = "INSERT INTO account.group_member
                    (group_id, user_id, createtime)
                VALUES
                    (:group_id, :user_id, NOW())
                ON DUPLICATE KEY UPDATE user_id=user_id";
        $this->bindQuery($sql, array(':user_id' => $user_id, ':group_id' => $group_id));
    }
    
    public function delGroupMember($group, $member){
        $sql = "DELETE FROM account.group_member WHERE user_id=:user_id AND group_id=:group_id ";
        $this->bindQuery($sql, array(':user_id' => $member, ':group_id' => $group));
    }
    
    /**
     * 找尋使用者擁有權限的帳務群組列表
     * @param UserVO $userVO
     * @param PageVO $pageVO
     * @param string $action
     *     執行抓取動作: PAGE 分頁資料, TOTAL 總數量
     */
    public function findUserGroupList($user_id, $pageVO, $action = 'PAGE'){
        $FROM = "FROM
                    account.detail_group AS g,
                    account.group_member AS m
                ";
        $WHERE = "WHERE
                    m.user_id=:user_id AND 
                    g.is_del=0 AND 
                    g.group_id=m.group_id
                ";
        if($action == 'PAGE'){
            return $this->getCommand(
                                "SELECT g.* "
                                .$FROM
                                .$WHERE
                                ."ORDER BY g.group_id DESC "
                                ."LIMIT :start, :limit " ,
                                array(
                                        ':start' => $pageVO->start,
                                        ':limit' => $pageVO->limit,
                                        ':user_id' => $user_id
                                )
                        )
                        ->queryAll();
        }else{
            $row = $this->getCommand(
                                "SELECT COUNT(g.group_id) AS count "
                                .$FROM
                                .$WHERE,
                                array(':user_id' => $user_id)
                            )
                            ->queryRow();
            return (empty($row))? 0: $row['count'];
        }
    
    }
    
    /**
     * 給予使用者與此群組是否擁有權限
     * @param integer $user_id
     * @param integer $group_id
     */
    public function findOwnerPowerGroup($user_id, $group_id){
        $sql = "SELECT g.*
                FROM
                    account.detail_group AS g,
                    account.group_member AS m
                WHERE
                    m.user_id=:user_id AND
                    m.group_id=:group_id AND
                    g.is_del=0 AND 
                    g.group_id=m.group_id
                ";
        return $this->queryRow($sql, array(':user_id' => $user_id, ':group_id' => $group_id));
    }
    
    /**
     * 找尋使用者"主要擁有"特定帳務群組
     * @param integer $user_id
     * @param integer $group_id
     */
    public function findUserGroup($user_id, $group_id){
        $sql = "SELECT * 
                FROM account.detail_group 
                WHERE user_id=:user_id AND group_id=:group_id AND is_del=0 ";
        return $this->queryRow(
                        $sql, 
                        array(':user_id' => $user_id, ':group_id' => $group_id)
                    );
    }
    
    /**
     * 找尋群組的使用者
     * @param integer $group_id
     */
    public function findGroupMember($group_id){
        $sql = "SELECT *
                FROM account.group_member
                WHERE group_id=:group_id ";
        return $this->getCommand(
                        $sql,
                        array(':group_id' => $group_id)
                    )
                    ->queryAll();
    }
    
    
    /**
     * 找尋群組明細資料
     * @param integer $group_id
     * @param DetailListSearchVO $detailListSearchVO
     * @param PageVO $pageVO
     * @param string $action
     * @return Ambigous <number, unknown>
     */
    public function findDetailList($group_id, $detailListSearchVO, $pageVO, $action = 'PAGE'){
        $FROM = "FROM
                    account.detail AS d
                ";
        $WHERE = "WHERE
                    d.group_id=:group_id AND d.is_del=0
                ";
        $params = array(':group_id' => $group_id);
        if($detailListSearchVO->time == 2){
            $WHERE .= ' AND receipt_date<=:endDate AND receipt_date>=:startDate ';
            $params[':startDate'] = $detailListSearchVO->start;
            $params[':endDate'] = $detailListSearchVO->end;
        }else if($detailListSearchVO->time == 1){
            $WHERE .= ' AND DATE_FORMAT(`receipt_date`, "%Y-%m")=:Ym ';
            $params[':Ym'] = sprintf('%04d-%02d', $detailListSearchVO->year, $detailListSearchVO->month);
        }
        if($detailListSearchVO->receipt!=''){
            $WHERE .= ' AND receipt=:receipt ';
            $params[':receipt'] = $detailListSearchVO->receipt;
        }
        
        if($detailListSearchVO->ownerId == -1){
            $WHERE .= ' AND owner=0 ';
        }else if($detailListSearchVO->ownerId > 0){
            $WHERE .= ' AND owner=:ownerId ';
            $params[':ownerId'] = $detailListSearchVO->ownerId;
        }
        if($action == 'PAGE'){
            $sortQuery = array(
                'a' => 'ASC',
                'd' => 'DESC'
            );
            $orderFieldQuery = array(
                'date' => 'ORDER BY d.receipt_date %1$s, detail_id %1$s',
                'name' => 'ORDER BY d.detail_title %s',
                'credit' => 'ORDER BY d.credit %s',
                'debit' => 'ORDER BY d.debit %s',
                'owner' => 'ORDER BY d.owner %s',
                'ct' => 'ORDER BY d.detail_id %s',
                'ut' => 'ORDER BY d.updatetime %s',
            );
            $params[':start'] = $pageVO->start;
            $params[':limit'] = $pageVO->limit;
            return $this->getCommand(
                            "SELECT d.* "
                            .$FROM
                            .$WHERE
                            .sprintf($orderFieldQuery[$detailListSearchVO->field], $sortQuery[$detailListSearchVO->sort])
                            ." LIMIT :start, :limit " ,
                            $params
                        )
                        ->queryAll();
        }else{
            $row = $this->getCommand(
                            "SELECT COUNT(d.detail_id) AS count "
                            .$FROM
                            .$WHERE,
                            $params
                        )
                        ->queryRow();
            return (empty($row))? 0: $row['count'];
        }
    }
    
    public function add($detailVO){
        $sql = "INSERT INTO account.detail
                    (
                        user_id, group_id, 
                        detail_title,
                        is_credit, credit, debit, 
                        receipt, receipt_date,
                        receipt_memo, owner,
                        createtime
                    )
                VALUES
                    (
                        :user_id, :group_id,
                        :detail_title,
                        :is_credit, :credit, :debit, 
                        :receipt, :receipt_date,
                        :receipt_memo, :owner,
                         NOW()
                    )";
        $this->bindQuery($sql, array(
            ':user_id' => $detailVO->userId,
            ':group_id' => $detailVO->groupId,
            ':detail_title' => $detailVO->title,
            ':is_credit' => $detailVO->isCredit,
            ':credit' => $detailVO->credit,
            ':debit' => $detailVO->debit,
            ':receipt' => $detailVO->receipt,
            ':receipt_date' => $detailVO->receiptDate,
            ':receipt_memo' => $detailVO->receiptMemo,
            ':owner' => $detailVO->owner
        ));
    }
    
    public function edit($detailVO){
        $sql = "UPDATE account.detail 
                SET 
                    detail_title=:detail_title,
                    is_credit=:is_credit, credit=:credit, debit=:debit,
                    receipt=:receipt,
                    receipt_date=:receipt_date,
                    receipt_memo=:receipt_memo,
                    owner=:owner,
                    updatetime=NOW()
                WHERE detail_id=:detail_id";
        $this->bindQuery($sql, array(
                ':detail_title' => $detailVO->title,
                ':is_credit' => $detailVO->isCredit,
                ':credit' => $detailVO->credit,
                ':debit' => $detailVO->debit,
                ':receipt' => $detailVO->receipt,
                ':receipt_date' => $detailVO->receiptDate,
                ':receipt_memo' => $detailVO->receiptMemo,
                ':owner' => $detailVO->owner,
                ':detail_id' => $detailVO->detailId,
        ));
    }
    
    public function del($user_id, $detail_id){
        $sql = "UPDATE account.detail SET is_del=1 WHERE detail_id=:detail_id AND user_id=:user_id ";
        $this->bindQuery($sql, array( 
            ':user_id' => $user_id,
            ':detail_id' => $detail_id,
        ));
    }
    
    public function findDetail($detail_id){
        $sql = "SELECT * FROM account.detail WHERE is_del=0 AND detail_id=:detail_id ";
        $row = $this->queryRow($sql, array(':detail_id' => $detail_id));
        
        if(empty($row)){
            return false;
        }
        
        $detailVO = new DetailVO;
        $detailVO->setData($row);
        
        return $detailVO;
    }
    
    /**
     * 找尋特一群組擁有者的入帳與出帳總金額
     * @param unknown $groupId
     */
    public function findGroupMemberOnwerMoney($groupId){
        $sql = "SELECT 
                    owner, 
                    SUM(credit) AS creditTotal,
                    SUM(debit) AS debitTotal
                FROM account.detail 
                WHERE 
                    is_del=0 AND group_id=:group_id
                GROUP BY owner
                ";
        return $this->getCommand(
                        $sql, 
                        array(':group_id' => $groupId)
                    )
                    ->queryAll();
        
    }
    
    public function findGroupYearMoney($groupId, $startYear, $endYear){
        $sql = "SELECT
                    DATE_FORMAT(`receipt_date`, '%Y') AS itemId,
                    SUM(credit) AS creditTotal,
                    SUM(debit) AS debitTotal
                FROM account.detail 
                WHERE
                    is_del=0 AND group_id=:group_id AND
                    DATE_FORMAT(`receipt_date`, '%Y')>=:start AND
                DATE_FORMAT(`receipt_date`, '%Y')<=:end
                GROUP BY DATE_FORMAT(`receipt_date`, '%Y') ";
        $list = $this->getCommand(
                        $sql,
                        array(
                            ':group_id' => $groupId,
                            ':start' => $startYear,
                            ':end' => $endYear
                        )
                    )
                    ->queryAll();
        $items = array();
        foreach ($list as $row){
            $detailItemListVO = new DetailItemListVO;
            $detailItemListVO->setData($row);
            $items[$row['itemId']] = $detailItemListVO;
        }
        return $items;
    }
    
    public function findGroupMonthMoney($groupId, $startMonth, $endMonth){
        $sql = "SELECT
                    DATE_FORMAT(`receipt_date`, '%Y-%m') AS itemId,
                    SUM(credit) AS creditTotal,
                    SUM(debit) AS debitTotal
                FROM account.detail
                WHERE
                    is_del=0 AND group_id=:group_id AND
                    DATE_FORMAT(`receipt_date`, '%Y-%m')>=:start AND
                DATE_FORMAT(`receipt_date`, '%Y-%m')<=:end
                GROUP BY DATE_FORMAT(`receipt_date`, '%Y-%m') ";
        $list = $this->getCommand(
                    $sql,
                    array(
                            ':group_id' => $groupId,
                            ':start' => $startMonth,
                            ':end' => $endMonth
                    )
                )
                ->queryAll();
        $items = array();
        foreach ($list as $row){
            $detailItemListVO = new DetailItemListVO;
            $detailItemListVO->setData($row);
            $items[$row['itemId']] = $detailItemListVO;
        }
        return $items;
    }
}