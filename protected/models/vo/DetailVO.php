<?php
class DetailVO{
	
	/**
	 * 帳務代碼
	 * @var integer
	 */
	public $detailId;
	
	/**
	 * 群組id
	 * @var integer
	 */
	public $groupId;
	
	/**
	 * 建立者
	 * @var integer
	 */
	public $userId;
	
	/**
	 * 帳務名稱
	 * @var string
	 */
	public $title;
	
	/**
	 * 此筆交易為
	 * 1: 入帳
	 * 0: 出帳
	 * @var integer
	 */
	public $isCredit;
	
	/**
	 * 入帳
	 * @var integer
	 */
	public $credit;
	
	/**
	 * 出帳
	 * @var integer
	 */
	public $debit;
	
	/**
	 * 發票號碼
	 * @var string
	 */
	public $receipt;
	
	/**
	 * 發票時間
	 * @var date
	 */
	public $receiptDate;
	
	/**
	 * 備註
	 * @var unknown
	 */
	public $receiptMemo;
	
	/**
	 * 帳務歸屬
	 * @var unknown
	 */
	public $owner;
	
	/**
	 * 建立時間
	 * @var datetime
	 */
	public $createtime;
	
	/**
	 * 更新時間
	 * last update
	 * @var datetime
	 */
	public $updatetime;
	
	
	public function setData($row){
		if(empty($row) || !is_array($row)){
			return false;
		}
		$this->detailId = $row['detail_id'];
		$this->groupId = $row['group_id'];
		$this->userId = $row['user_id'];
		$this->title = $row['detail_title'];
		$this->isCredit = $row['is_credit'];
		$this->credit = $row['credit'];
		$this->debit = $row['debit'];
		$this->receipt = $row['receipt'];
		$this->receiptDate = $row['receipt_date'];
		$this->receiptMemo = $row['receipt_memo'];
		$this->owner = $row['owner'];
		$this->createtime = $row['createtime'];
		$this->updatetime = $row['updatetime'];
	}
	
}