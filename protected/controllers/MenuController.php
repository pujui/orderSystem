<?php
class MenuController extends FrameController{

    private $sellStatusList = [
        -1  => '已刪除',
         0  => '販賣中',
         1  => '暫停販賣'
    ];
    
    
    public function __construct(){

        $userManager = new UserManager;

        $isLogin = $userManager->isLogin();
        $this->setVariable('isLogin', $isLogin);
        if($isLogin === true){
            $this->setVariable('user', $userManager->getLogin());
        }else{
            $this->actionErrorPage();
        }

        $this->setVariable('navBarMenu', 'active');
        $this->setCSS('/css/menu.css');

        $this->BreadCrumbs[Yii::app()->request->baseUrl] = '首頁';

        parent::__construct();
    }

    /**
     * 群組列表頁
     */
    public function actionIndex(){

        $pageVO = new PageVO;
        $pageVO->page = intval($_GET['p']);
        $pageVO->limit = 30;
        
        $userVO = UserManager::getLogin();
        $menuManager = new MenuManager;

        $menuListPage = $menuManager->findMenuList($pageVO);
        
        $this->BreadCrumbs['last'] = '菜單管理';
        
        $this->pageTitle = '菜單管理：列表';
        
        $this->setCSS('/js/jquery/jquery-ui-1.10.3.custom/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        
        $this->setJS('/js/menu/index.js');
        
        $this->layout('menu/index', array(
            'menuListPage'      => $menuListPage,
            'sellStatusList'   => $this->sellStatusList,
        ));
    }

    public function actionAdd(){
        try {
            $menuDAO = new MenuDAO;
            $menuManager = new MenuManager;
            $firstClassList = $menuDAO->findMenuClass();
            $errorCode = 0;
            if(isset($_POST['name'])){
                $menuManager->add($_POST);
                $this->redirect(Yii::app()->request->baseUrl.'/menu/');
            }
        }catch (MenuException $e){
            $errorCode = $e->getMessage();
        }
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/menu/'] = '菜單管理';
        
        $this->BreadCrumbs['last'] = '新增商品';
        
        $this->pageTitle = '菜單管理：新增商品';
        
        $this->layout('menu/add', array(
            'firstClassList'    => $firstClassList,
            'errorCode'         => $errorCode,
        ));
    }

    public function actionEdit($id){
        try {
            $menuDAO = new MenuDAO;
            $menuManager = new MenuManager;
            $firstClassList = $menuDAO->findMenuClass();
            $menuData = $menuDAO->findMenuId($id);
            if(empty($menuData)){
                throw new MenuException(MenuException::ERR_NOT_EXISTS);
            }
            $code = 0;
            $priceList = [];
            for($i=1; $i < 11; $i++){
                $priceList[$i] = [$menuData['className'.$i], $menuData['classPrice'.$i]];
            }
            if(isset($_POST['name'])){
                try {
                    $menuManager->edit($id, $_POST);
                    $this->redirect(Yii::app()->request->baseUrl.'/menu/');
                }catch (MenuException $e){
                    $errorCode = $e->getMessage();
                }
            }
        }catch (MenuException $e){
            $errorCode = $e->getMessage();
        }
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/menu/'] = '菜單管理';
        
        $this->BreadCrumbs['last'] = '編輯商品';
        
        
        $this->pageTitle = '菜單管理：編輯商品';
        $this->layout('menu/add', array(
            'firstClassList'    => $firstClassList,
            'menuData'          => $menuData,
            'priceList'         => $priceList,
            'errorCode'         => $errorCode,
        ));
    }

    public function actionExtra(){
        $menuManager = new MenuManager;
        if(isset($_POST['extraId'])){
            try {
                $menuManager->editExtral($_POST);
                $this->redirect(Yii::app()->request->baseUrl.'/menu/');
            }catch (MenuException $e){
                $this->redirect(Yii::app()->request->baseUrl.'/menu/');
            }
        }
        $list = $menuManager->findExtral();
        $this->layout('menu/extra', array(
            'list'    => $list,
        ));
    }
}