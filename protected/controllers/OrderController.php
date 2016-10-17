<?php
class OrderController extends FrameController{

    public function __construct(){
        $this->setCSS('/css/order.css');
    
        $userManager = new UserManager;
    
        $isLogin = $userManager->isLogin();
        $this->setVariable('isLogin', $isLogin);
        if($isLogin === true){
            $this->setVariable('user', $userManager->getLogin());
        }else{
            $this->actionErrorPage();
        }
        $this->BreadCrumbs[Yii::app()->request->baseUrl] = '首頁';

        parent::__construct();
    }

    public function actionIndex(){
        
        $userVO = UserManager::getLogin();

        $pageVO = new PageVO;
        $pageVO->page = intval($_GET['p']);
        $pageVO->limit = 30;
        $orderManager = new OrderManager;
        $orderListPage = $orderManager->findOrderList($pageVO);
        
        $this->BreadCrumbs['last'] = '訂單管理';
        
        $this->pageTitle = '訂單管理：列表';
        
        $this->layout('order/index', array(
            'orderListPage' => $orderListPage
        ));
    }

    public function actionAdd(){
        $menuManager = new MenuManager;
        $showList = $menuManager->show();
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/order/'] = '訂單管理';
        
        $this->BreadCrumbs['last'] = '新增定單';
        
        $this->pageTitle = '訂單管理：新增定單';

        $this->setJS('/js/order/add.js');
        
        $this->layout('order/add', array(
            'showList' => $showList
        ));
    }

}