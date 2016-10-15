<?php
class ArticleController extends FrameController
{

	public function __construct(){
		$this->setJS(array(
			'/js/jquery/underscore-min.js',
			'/js/jquery/backbone-min.js'
		));
	
		$userManager = new UserManager;
	
		$isLogin = $userManager->isLogin();
		$this->setVariable('isLogin', $isLogin);
		if($isLogin === true){
			$this->setVariable('user', $userManager->getLogin());
		}else{
			$this->actionloginPage();
		}
	
		$this->BreadCrumbs[Yii::app()->request->baseUrl] = '首頁';
	}
	
	public function actionIndex(){
		$this->BreadCrumbs['last'] = '發文系統';
		
		$this->pageTitle = '發文系統';
		
		$this->setJS('/js/detail/index.js');
		
		$this->layout('article/index', array(
		));
	}
}