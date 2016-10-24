<?php
class OrderController extends FrameController{

    private $statusList = [
         0  => '已取消',
         1  => '已成立'
    ];
    
    public function __construct(){
        $this->setCSS('/css/order.css');
    
        $userManager = new UserManager;
    
        $isLogin = $userManager->isLogin();
        $this->setVariable('isLogin', $isLogin);
        if($isLogin === true){
            $this->setVariable('user', $userManager->getLogin());
        }
        $this->BreadCrumbs[Yii::app()->request->baseUrl] = '首頁';

        parent::__construct();
    }
    
    private function __check_login(){
        if(UserManager::isLogin() !== true){
            $this->actionErrorPage();
        }
    }

    public function actionIndex(){
        $this->__check_login();
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

        $this->setVariable('navBarOrder', 'active');

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
        $this->__check_login();
        $menuManager = new MenuManager;
        $showList = $menuManager->show();
        try {
            if(isset($_POST['itemPrice'])){
                $userVO = UserManager::getLogin();
                $orderManager = new OrderManager;
                $order = $orderManager->add($userVO, $_POST);
                if($_POST['print'] == '1'){
                    $this->redirect(Yii::app()->request->baseUrl.'/order/updatePrint/?tp=3&id='.$order[0].'&orderNo='.$order[1]);
                }else{
                    $this->redirect(Yii::app()->request->baseUrl.'/order/');
                }
            }
        }catch (MenuException $e){
            $errorCode = $e->getMessage();
            $this->redirect(Yii::app()->request->baseUrl.'/order/');
        }

        $this->setVariable('navBarAddOrder', 'active');
        $extraMenuList = $menuManager->findExtral(1);
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/order/'] = '訂單管理';
        
        $this->BreadCrumbs['last'] = '新增定單';
        
        $this->pageTitle = '訂單管理：新增定單';

        $this->setCSS('/js/jquery/jquery-ui-1.10.3.custom/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        
        $this->setJS('/js/jquery/jquery.blockUI.js');
        
        $this->setJS('/js/order/add.js');
        
        $this->layout('order/add', array(
            'showList' => $showList,
            'extraMenuList' => $extraMenuList
        ));
    }

    public function actionEdit($id = 0, $s = 0){
        $this->__check_login();
        $statusList = [ 1 => 1, 2 => 0];
        if($id > 0 && isset($statusList[$s])){
            $orderDAO = new OrderDAO;
            $orderDAO->updateStatus($id, $statusList[$s]);
        }
        $this->redirect(Yii::app()->request->baseUrl.'/order/');
    }

    public function actionUpdatePrint($id = 0, $orderNo = '', $tp = 0){
        $this->__check_login();
        $date_fix = date('YmdHis');
        /**
         * 產生TAG檔
         */
        if($tp == 1 || $tp == 3){
            $tagContent = file_get_contents(WEB_PATH.'/order/print?tp=1&id='.$id);
            $file = fopen(dirname(__FILE__)."/../../prints/tag/{$date_fix}_{$id}_{$orderNo}.html","w");
            fwrite($file, $tagContent);
            fclose($file);
        }
        /**
         * 產生明細檔
         */
        if($tp == 2 || $tp == 3){
            $tagContent = file_get_contents(WEB_PATH.'/order/print?tp=2&id='.$id);
            $file = fopen(dirname(__FILE__)."/../../prints/list/{$date_fix}_{$id}_{$orderNo}.html","w");
            fwrite($file, $tagContent);
            fclose($file);
        }
        $this->redirect(Yii::app()->request->baseUrl.'/order/print?show=1&id='.$id);
    }

    public function actionPrint($id, $tp = 0, $show = 0){
        if($id < 0) $this->actionErrorPage();
        $pageVO = new PageVO;
        $pageVO->page = intval($_GET['p']);
        $pageVO->params = $_GET;
        $pageVO->limit = 1;
        $search = [
            'orderId'=> $id
        ];
        $orderManager = new OrderManager;
        $orderListPage = $orderManager->findOrderList($pageVO, $search);
        if(empty($orderListPage->details)) $this->actionErrorPage();
        $order = array_pop($orderListPage->details);
        $this->renderPartial('order/print', [ 'order' => $order, 'tp' => $tp, 'show' => $show]);
    }

    public function actionPrintList(){
        if(UserManager::isLogin() !== true){
            $this->actionErrorPage();
        }
        $userVO = UserManager::getLogin();
        $pageVO = new PageVO;
        $pageVO->page = intval($_GET['p']);
        $pageVO->params = $_GET;
        $pageVO->limit = 10;
        $search = [
            'needPrint' => 1
        ];
        $this->setVariable('navBarOrderPrint', 'active');
        $orderManager = new OrderManager;
        $orderListPage = $orderManager->findOrderList($pageVO, $search);
        $this->layout('order/printList', array(
            'orderListPage' => $orderListPage,
        ));
    }
}