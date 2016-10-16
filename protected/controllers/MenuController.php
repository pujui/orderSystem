<?php
class MenuController extends FrameController
{

    public function __construct(){
        $this->setCSS('/css/detail/detail.css');

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

    /**
     * 群組列表頁
     */
    public function actionIndex(){
        
        $pageVO = new PageVO;
        $pageVO->page = intval($_GET['p']);
        
        $userVO = UserManager::getLogin();
        
        $this->BreadCrumbs['last'] = '菜單管理';
        
        $this->pageTitle = '菜單管理';
        
    }

}