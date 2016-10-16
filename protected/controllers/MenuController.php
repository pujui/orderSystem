<?php
class MenuController extends FrameController
{

    public function __construct(){

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
        $pageVO->limit = 30;
        
        $userVO = UserManager::getLogin();
        $menuManager = new MenuManager;

        $menuListPage = $menuManager->findMenuList($pageVO);
        
        $this->BreadCrumbs['last'] = '菜單管理';
        
        $this->pageTitle = '菜單管理：列表';

        $this->layout('menu/index', array(
            'menuListPage' => $menuListPage
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
    
}