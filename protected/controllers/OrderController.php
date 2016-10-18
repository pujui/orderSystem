<?php
class OrderController extends FrameController{

    private $statusList = [
        -1  => '已刪除',
         0  => '未處理',
         1  => '已處理'
    ];
    
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
        $pageVO->params = $_GET;
        $pageVO->limit = 30;
        $search = [
            'start' => $_GET['start'],
            'end'   => $_GET['end'],
            'status'=> $_GET['status']
        ];
        $orderManager = new OrderManager;
        $orderListPage = $orderManager->findOrderList($pageVO, $search);
        

        $orderDAO = new OrderDAO();
        $months = $orderDAO->findDataForLastMonth();
        $days = $orderDAO->findDataForLastDay();
        $this->BreadCrumbs['last'] = '訂單管理';
        
        $this->pageTitle = '訂單管理：列表';

        $this->setCSS('/js/jquery/jquery-ui-1.10.3.custom/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        
        $this->setJS('/js/jquery/jquery.blockUI.js');
        
        $this->setJS('/js/order/index.js');
        
        $this->layout('order/index', array(
            'orderListPage' => $orderListPage,
            'statusList'    => $this->statusList,
            'months'        => $months,
            'days'          => $days
        ));
    }

    public function actionAdd(){
        $menuManager = new MenuManager;
        $showList = $menuManager->show();

        try {
            if(isset($_POST['itemPrice'])){

                $userVO = UserManager::getLogin();
                $orderManager = new OrderManager;
                $orderManager->add($userVO, $_POST);
                $this->redirect(Yii::app()->request->baseUrl.'/order/');
            }
        }catch (MenuException $e){
            $errorCode = $e->getMessage();
            $this->redirect(Yii::app()->request->baseUrl.'/order/');
        }
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/order/'] = '訂單管理';
        
        $this->BreadCrumbs['last'] = '新增定單';
        
        $this->pageTitle = '訂單管理：新增定單';

        $this->setCSS('/js/jquery/jquery-ui-1.10.3.custom/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        
        $this->setJS('/js/jquery/jquery.blockUI.js');
        
        $this->setJS('/js/order/add.js');
        
        $this->layout('order/add', array(
            'showList' => $showList,
            'hideHeader' => 1
        ));
    }

    public function actionEdit($id = 0, $s = 0){
        $statusList = [ 1 => 1, 2 => -1];
        if($id > 0 && isset($statusList[$s])){
            $orderDAO = new OrderDAO;
            $orderDAO->updateStatus($id, $statusList[$s]);
        }
        $this->redirect(Yii::app()->request->baseUrl.'/order/');
    }
}