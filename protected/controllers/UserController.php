<?php
class UserController extends FrameController{
    
    public $layout='//layouts/frame';

    private $activeList = [ -1 => 'delete', 0 => 'close', 1 => 'normal', 2 => 'root'];

    public function __construct(){
        $this->setCSS('/css/user/user.css');
        
        $userManager = new UserManager;
        
        $isLogin = $userManager->isLogin();
        $this->setVariable('isLogin', $isLogin);
        if($isLogin === true){
            $this->setVariable('user', $userManager->getLogin());
        }
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl] = '首頁';

        parent::__construct();
    }
    
    /**
     * 首頁
     */
    public function actionIndex(){
        
        $userManager = new UserManager;
        $userVO = $userManager->getLogin();
        $userList = $userVO->isActive == 2 ? $userManager->findUserList(): [];

        $this->setJS('/js/user/user.js');
        $this->layout('user/index', array(
            'userList' => $userList,
            'activeList' => $this->activeList
        ));
    }
    
    /**
     * 新增帳號
     */
    public function actionAdd(){

        $userManager = new UserManager;

        if(isset($_POST['account'], $_POST['password'])){

            $userAddFormVO = new UserAddFormVO;
            $userAddFormVO->setData($_POST);
            try {
                $userManager->add($userAddFormVO);
                $this->actionloginPage();
            }catch (UserException $e){
                $userAddFormVO->errorCode = $e->getMessage();
            }
        }

        $this->BreadCrumbs['last'] = '建立帳號';
        $this->setJS('/js/user/add.js');

        $this->layout('user/add', array(
            'userAddFormVO' => $userAddFormVO,
        ));
    }

    /**
     * 編輯帳號
     * @param integer $editUserId
     */
    public function actionEdit($id = 0){
        if($id < 1){
            $this->actionloginPage();
        }

        $userManager = new UserManager;
        $userAddFormVO = new UserAddFormVO;
        try {
            $editUserVO = $userManager->findUser($id);
            $userVO = $userManager->getLogin();
            if($_POST['edit'] == 1){
                $userAddFormVO->setData($_POST);
                $userManager->edit($userVO, $id, $userAddFormVO);
                $this->actionloginPage();
            }
        }catch (UserException $e){
            $userAddFormVO->errorCode = $e->getMessage();
        }
        $this->BreadCrumbs['last'] = '編輯帳號';
        $this->setJS('/js/user/add.js');
        $this->layout('user/add', array(
            'editUserVO'    => $editUserVO,
            'userAddFormVO' => $userAddFormVO
        ));
    }


    /**
     * 登入頁
     */
    public function actionLogin(){
        
        $userManager = new UserManager;
        
        if($userManager->isLogin()){
            $this->actionloginPage();
        }
        
        $loginFormVO = null;
        if(isset($_POST['account'], $_POST['password'])){
            $loginFormVO = new LoginFormVO;
            $loginFormVO->account = $_POST['account'];
            $loginFormVO->password = '';
            try {
                $userManager->doLogin($loginFormVO->account, $_POST['password']);
                $this->actionloginPage();
            }catch (UserException $e){
                $loginFormVO->errorCode = 1;
            }
        }
        
        $this->BreadCrumbs['last'] = '登入頁';
        
        $this->layout('user/login', array(
            'loginFormVO' => $loginFormVO,
        ));
    }

    /**
     * 登出頁
     */
    public function actionLogout(){
        $userManager = new UserManager;
        $userManager->logout();
        $this->actionloginPage();
    }

    public function actionloginPage(){
        $this->redirect(Yii::app()->request->baseUrl.'/user/');
    }
}