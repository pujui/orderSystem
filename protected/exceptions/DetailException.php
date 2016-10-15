<?php

class DetailException extends Exception{

	const ERR_VALUE_IS_EMPTY    = 200; //輸入為空值
	
	const ERR_DEL_GROUP_OWNER   = 201; //刪除者不是主要擁有者

	public function __construct(){
		
	}
}