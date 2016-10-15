<?php
class UserController extends FrameController
{
    
    public $layout='//layouts/frame';

    public function __construct(){
        $this->setCSS('/css/user/user.css');
        $this->setJS('/js/user/user.js');
        
        $userManager = new UserManager;
        
        $isLogin = $userManager->isLogin();
        $this->setVariable('isLogin', $isLogin);
        if($isLogin === true){
            $this->setVariable('user', $userManager->getLogin());
        }
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl] = '首頁';
    }
    
    /**
     * member index page
     */
    public function actionIndex(){
        
        $userManager = new UserManager;
        $userVO = $userManager->getLogin();
        $userList = $userVO->isActive == 2 ? $userManager->findUserList(): [];

        $this->layout('user/index', array(
            'userList' => $userList,
        ));
    }
    
    /**
     * member index page
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

        $this->BreadCrumbs['last'] = '新增帳號';
        $this->setJS('/js/user/add.js');

        $this->layout('user/add', array(
            'userAddFormVO' => $userAddFormVO,
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