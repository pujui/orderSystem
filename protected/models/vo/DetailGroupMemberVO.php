<?php
class DetailGroupMemberVO{
	
	public $groupId;
	
	public $userId;
	
	public $createtime;
	
	public $user = array();
	
	public function setData($row){
		if(empty($row) || !is_array($row)){
			return false;
		}
		$this->groupId = $row['group_id'];
		$this->userId = $row['user_id'];
		$this->createtime = $row['createtime'];
		return true;
	}
	
}