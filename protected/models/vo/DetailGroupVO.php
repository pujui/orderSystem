<?php
class DetailGroupVO{
	
	/**
	 * 群組ID
	 * @var integer
	 */
	public $groupId;
	
	/**
	 * 建立者ID
	 * @var integer
	 */
	public $userId;
	
	public $title;
	
	/**
	 * 刪除狀態
	 *  0: 正常
	 *  1: 刪除
	 * @var integer
	 */
	public $isDel;
	
	/**
	 * 建立時間
	 * @var datetime
	 */
	public $createtime;
	
	/**
	 * 更新時間
	 * @var datetime
	 */
	public $updatetime;
	
	/**
	 * 成員列表: 限制最多成員20人
	 * @var DetailGroupMemberVO[]
	 */
	public $members = array();
	
	public function setData($row){
		if(empty($row) || !is_array($row)){
			return false;
		}
		$this->groupId = $row['group_id'];
		$this->userId = $row['user_id'];
		$this->title = $row['group_title'];
		$this->isDel = $row['is_del'];
		$this->createtime = $row['createtime'];
		$this->updatetime = $row['updatetime'];
		return true;
	}
}