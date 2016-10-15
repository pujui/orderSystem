<?php
class DetailManager{
	
	/**
	 * 新增帳務群組
	 * @param UserVO $userVO
	 * @param string $title
	 * @throws DetailException
	 */
	public function doAddGroup($userVO, $title){
		$title = trim($title);
		if($title == ''){
			throw new DetailException(DetailException::ERR_VALUE_IS_EMPTY);
			
		}
		$detailDAO = new DetailDAO;
		$detailDAO->addGroup($userVO->userId, $title);
	}
	
	public function doEditGroup($userVO, $group_id, $title){
		$title = trim($title);
		if($title == ''){
			throw new DetailException(DetailException::ERR_VALUE_IS_EMPTY);
				
		}
		$detailGroupVO = $this->findUserGroup($userVO, $group_id);
		
		if(empty($detailGroupVO)){
			throw new DetailException(DetailException::ERR_DEL_GROUP_OWNER);
		}
		$detailDAO = new DetailDAO;
		$detailDAO->editGroup($userVO->userId, $group_id, $title);
	}
	
	
	/**
	 * 
	 * @param UserVO $userVO
	 * @param integer $group_id
	 * @throws DetailException
	 */
	public function doDelGroup($userVO, $group_id){
		
		$detailGroupVO = $this->findUserGroup($userVO, $group_id);
		
		if(empty($detailGroupVO)){
			throw new DetailException(DetailException::ERR_DEL_GROUP_OWNER);
		}
		
		$detailDAO = new DetailDAO;
		$detailDAO->delGroup($group_id);
	}
	
	/**
	 * 新增群組成員
	 * @param integer $group_id
	 * @param string $account
	 * @throws DetailException
	 */
	public function doAddGroupMember($group_id, $account){
		$account = trim($account);
		if($account == ''){
			throw new DetailException(DetailException::ERR_VALUE_IS_EMPTY);
		}
		$userDAO = new UserDAO;
		$user = $userDAO->findAccount($account);
		if(!empty($user)){
			$detailDAO = new DetailDAO;
			$detailDAO->addGroupMember($group_id, $user['user_id']);
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 刪除帳務群組成員
	 * @param UserVO $userVO
	 * @param interge $group_id
	 * @param interge $user_id
	 */
	public function doDelGroupMember($userVO, $group_id, $user_id){
		$group_id = trim($group_id);
		$user_id = trim($user_id);
		if(in_array('', array($group_id, $user_id))){
			throw new DetailException(DetailException::ERR_VALUE_IS_EMPTY);
		}
		$detailGroupVO = $this->findUserGroup($userVO, $group_id);
		if(!empty($detailGroupVO) && $detailGroupVO->userId!=$user_id){
			$detailDAO = new DetailDAO;
			$detailDAO->delGroupMember($group_id, $user_id);
		}
	}
	
	/**
	 * 找尋使用者所擁有的帳務群組
	 * @param integer $user_id
	 * @param integer $start
	 * @param integer $end
	 */
	public function findUserGroupList($userVO, $pageVO){
		$detailDAO = new DetailDAO;
		
		$pageVO->total = $detailDAO->findUserGroupList($userVO->userId, $pageVO, 'TOTAL');
		$pageVO->createStartRange();
		
		$list = $detailDAO->findUserGroupList($userVO->userId, $pageVO, 'PAGE');
		
		$detailGroupPage = new DetailGroupPage;
		$detailGroupPage->pageVO = $pageVO;
		$detailGroupPage->detailGroupVOList = array();
		
		foreach ($list as $row){
			$detailGroupVO = new DetailGroupVO;
			$detailGroupVO->setData($row);
			$detailGroupPage->detailGroupVOList[] = $detailGroupVO;
		}
		
		return $detailGroupPage;
		
	}
	
	/**
	 * 使用者擁有特定群組
	 * @param UserVO $userVO
	 * @param integer $group_id
	 * @return Ambigous <multitype:, DetailGroupVO>
	 */
	public function findUserGroup($userVO, $group_id){
		$detailDAO = new DetailDAO;
		$row = $detailDAO->findUserGroup($userVO->userId, $group_id);
		
		$detailGroupVO = array();
		if(!empty($row)){
			$detailGroupVO = new DetailGroupVO;
			$detailGroupVO->setData($row);
			$detailGroupVO->members = $this->findGroupMember($group_id);
		}
		return $detailGroupVO;
	}
	
	/**
	 * 找尋群組成員
	 * @param integer $group_id
	 * @return multitype:DetailGroupMemberVO
	 */
	public function findGroupMember($group_id){
		$detailDAO = new DetailDAO;
		$list = $detailDAO->findGroupMember($group_id);
		$groupMemberList = array();
		$users = $userIds = array();
		foreach ($list as $row){
			$detailGroupMemberVO = new DetailGroupMemberVO;
			$detailGroupMemberVO->setData($row);
			$groupMemberList[] = $detailGroupMemberVO;
			$userIds[] = $row['user_id'];
		}
		$userDAO = new UserDAO;
		$temps = $userDAO->findUserIds($userIds);
		foreach ($temps as $row){
			$userVO = new UserVO;
			$userVO->setData($row);
			$users[$row['user_id']] = $userVO;
		}
		foreach ($groupMemberList as $row){
			$row->user = $users[$row->userId];
		}
		return $groupMemberList;
	}
	
	/**
	 * 給予群組明細資料
	 * @param integer $group_id
	 * @param PageVO $pageVO
	 * @return DetailListFormVO
	 */
	public function getDetailList($group_id, $detailListSearchVO, $pageVO){
		
		$detailListFormVO = new DetailListFormVO;
		
		$detailDAO = new DetailDAO;
		
		$pageVO->total = $detailDAO->findDetailList($group_id, $detailListSearchVO, $pageVO, 'TOTAL');
		$pageVO->createStartRange();
		
		$list = $detailDAO->findDetailList($group_id, $detailListSearchVO, $pageVO, 'PAGE');
		
		if($detailListSearchVO->time == 0){
			$useYear = sprintf('%04d', $detailListSearchVO->year);
			$useMonth = sprintf('%04d-%02d', $detailListSearchVO->year, $detailListSearchVO->month);
			$prevYear = date('Y', strtotime($useYear.'-01-01 00:00:00 -5 year'));
			$thisYear = $useYear;
			$nextYear = date('Y', strtotime($useYear.'-01-01 00:00:00 +5 year'));
			$prevMonth = date('Y-m', strtotime($useMonth.'-01 00:00:00 -5 months'));
			$thisMonth = date('Y-m', strtotime($useMonth.'-01 00:00:00'));
			$nextMonth = date('Y-m', strtotime($useMonth.'-01 00:00:00 +5 months'));
			$detailListFormVO->years = $detailDAO->findGroupYearMoney($group_id, $prevYear, $nextYear);
			$detailListFormVO->months = $detailDAO->findGroupMonthMoney($group_id, $prevMonth, $nextMonth);
			
		}
		
		$detailListFormVO->pageVO = $pageVO;
		$detailListFormVO->details = array();
		
		foreach ($list as $row){
			$detailVO = new DetailVO;
			$detailVO->setData($row);
			$detailListFormVO->details[] = $detailVO;
		}
		
		$list = $detailDAO->findGroupMemberOnwerMoney($group_id);
		
		foreach ($list as $row){
			$detailMemberGroup = new DetailMemberGroup;
			$detailMemberGroup->setData($row);
			$detailListFormVO->memberGroup[] = $detailMemberGroup;
		}
		
		return $detailListFormVO;
	}
	
	public function getUrlEncodeParamString($params){
		
		if(empty($params)){
			return '';
		}
		
		$pageParamList = array();
		
		foreach ($params as $field=>$value){
			if(is_array($value)){
				foreach ($value as $v){
					$pageParamList[] = sprintf('%s[]=%s', $field, urlencode($v));
				}
			}else{
				$pageParamList[] = sprintf('%s=%s', $field, urlencode($value));
			}
		}
		
		return '&amp;'.implode('&amp;', $pageParamList);
	}
	
	/**
	 * 給予目前使用者是否擁有此權限群組
	 * @param unknown $userVO
	 * @param unknown $group_id
	 * @return boolean|DetailGroupVO
	 */
	public function getOwnerGroup($userVO, $group_id){
		$detailDAO = new DetailDAO;
		$row = $detailDAO->findOwnerPowerGroup($userVO->userId, $group_id);
		if($row === false){
			return false;
		}
		$detailGroupVO = new DetailGroupVO;
		$detailGroupVO->setData($row);
		return $detailGroupVO;
	}
	
	/**
	 * 新增群組明細
	 * @param DetailVO $detailVO
	 */
	public function add($detailVO){
		$detailDAO = new DetailDAO;
		$detailDAO->add($detailVO);
	}
	
	/**
	 * 編輯明細
	 * @param DetailVO $detailVO
	 */
	public function edit($detailVO){
		$detailDAO = new DetailDAO;
		$detailDAO->edit($detailVO);
	}
	
	/**
	 * 將明細標記成刪除
	 * @param unknown $userVO
	 * @param unknown $detail_id
	 */
	public function del($userVO, $detail_id){
		$detailDAO = new DetailDAO;
		$detailDAO->del($userVO->userId, $detail_id);
	}
	
	/**
	 * 給予特定明細
	 * @param unknown $detail_id
	 */
	public function getDetail($detail_id){
		$detailDAO = new DetailDAO;
		return $detailDAO->findDetail($detail_id);
	}
	
}