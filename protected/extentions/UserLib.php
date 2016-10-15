<?php
class UserLib{
	
	public $user_id = null;
	public $user_acc = null;
	public $last_login_time = null;
	
	public function __construct(){
		if($this->isLogin()){
			$this->user_id = Yii::app()->session['user_id'];
			$this->user_acc = Yii::app()->session['user_acc'];
			$this->last_login_time = Yii::app()->session['last_login_time'];
		}
	}
	
	/**
	 * check user status
	 */
	public function isLogin(){
		return Yii::app()->session['user_id'] > 0;
	}
	
	/**
	 * Do login
	 * @param unknown_type $user
	 */
	public function login($user){
	
		if(is_array($user)){
			$user = (object)$user;
		}
		
		if(isset($user->user_id)){
			Yii::app()->session['user_id'] = $user->user_id;
		}
		
		if(isset($user->user_acc)){
			Yii::app()->session['user_acc'] = $user->user_acc;
		}
		
		if(isset($user->last_login_time)){
			Yii::app()->session['last_login_time'] = $user->last_login_time;
		}
		
	}
	
	/**
	 * Do logout
	 */
	public function logout(){
		//Yii::app()->session->sessionID;
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		
	}
	
	public function checkPwd($user, $password){
		return ($user->user_pwd == $password);
	}
	
}
