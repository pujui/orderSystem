<?php
class UserException extends Exception{
	
	const ERR_LOGIN_FAILED    = 100; //帳號或密碼錯誤
	const ERR_VALUE_IS_EMPTY  = 101; //輸入的值為空直
	const ERR_PASSWORD_DIFFERENT = 102; //輸入兩次的密碼不相同
	const ERR_ACCOUNT_EXISTS = 103; //輸入帳號已存在
	
}