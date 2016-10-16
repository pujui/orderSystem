<?php
class UserManager{


    /**
     * 使用者List
     */
    public function findUserList(){
        $userDAO = new UserDAO;
        $list = $userDAO->findUserList();
        $userList = [];
        foreach ($list as $row){
            $userVO = new UserVO();
            $userVO->setData($row);
            $userList[] = $userVO;
        }
        return $userList;
    }

    /**
     * 新增帳號
     * @param unknown $userAddFormVO
     * @throws UserException
     */
    public function add($userAddFormVO)
    {
        // 基本檢查: password正確, active狀態, account不重複
        if($userAddFormVO->password != $userAddFormVO->confirmPassword){
            throw new UserException(UserException::ERR_PASSWORD_DIFFERENT);
        }
        if(!in_array($userAddFormVO->isActive, ['0', '1', '2'])){
            throw new UserException(UserException::ERR_VALUE_IS_EMPTY);
        }
        if(in_array('', array($userAddFormVO->account, $userAddFormVO->name))){
            throw new UserException(UserException::ERR_VALUE_IS_EMPTY);
        }
        $userVO = new UserVO();
        if($userVO->setData((array) $userAddFormVO) === false){
            throw new UserException(UserException::ERR_VALUE_IS_EMPTY);
        }
        $userDAO = new UserDAO;
        $row = $userDAO->findAccount($userAddFormVO->account);
        if(!empty($row)){
            throw new UserException(UserException::ERR_ACCOUNT_EXISTS);
        }
        $userVO->privateKey = $this->createPrivateKey();
        $userVO->password = $this->getHashPassword($userVO->password, $userVO->privateKey);
        $userDAO->addUser($userVO);
    }

    public function findUser($userId){
        $userDAO = new UserDAO;
        $row = $userDAO->findUserId($userId);
        if(empty($row)){
            throw new UserException(UserException::ERR_LOGIN_FAILED);
        }
        // set user data
        $userVO = new UserVO();
        if($userVO->setData($row) === false){
            throw new UserException(UserException::ERR_LOGIN_FAILED);
        }
        return $userVO;
    }

    public function edit($userVO, $editUserId, $userAddFormVO){
        if($userVO->isActive != 2){
            throw new UserException(UserException::ERR_POWER);
        }
        if($userAddFormVO->password != $userAddFormVO->confirmPassword){
            throw new UserException(UserException::ERR_PASSWORD_DIFFERENT);
        }
        $editUserVO = $this->findUser($editUserId);
        $editUserVO->isActive = $userAddFormVO->isActive;
        $editUserVO->name = $userAddFormVO->name;

        $userDAO = new UserDAO;
        if($userAddFormVO->confirmPassword != ''){
            $editUserVO->privateKey = $this->createPrivateKey();
            $editUserVO->password = $this->getHashPassword($userAddFormVO->confirmPassword, $editUserVO->privateKey);
            $userDAO->editUser($editUserVO, 1);
        } else {
            $userDAO->editUser($editUserVO);
        }
    }

    /**
     * 確認後登入
     * @param string $account
     * @param string $password
     */
    public function doLogin($account, $password){
        $account = trim($account);
        $password = trim($password);
        if(in_array('', array($account, $password))){
            throw new UserException(UserException::ERR_VALUE_IS_EMPTY);
        }
        
        // find data for this account
        $userDAO = new UserDAO;
        $row = $userDAO->findAccount($account);

        // set user data
        $userVO = new UserVO();
        if($userVO->setData($row) === false){
            throw new UserException(UserException::ERR_LOGIN_FAILED);
        }
        if($userVO->isActive == 0){
            throw new UserException(UserException::ERR_LOGIN_FAILED);
        }
        $password = $this->getHashPassword($password, $userVO->privateKey);
        if($password != $userVO->password){
            throw new UserException(UserException::ERR_LOGIN_FAILED);
        }
        $this->setLogin($userVO);
    }
    
    /**
     * 對密碼加密hash處理
     * @param string $password
     * @param string $private
     * @return string
     */
    public function getHashPassword($password, $private){
        //暫時先隨便用
        return sha1($password.$private);
    }
    
    /**
     * 隨機產生一組加密用的private key
     */
    public function createPrivateKey(){
        return 'asdfqwe';
    }
    
    /**
     * 設定登入資料
     * @param unknown $userVO
     */
    public static function setLogin($userVO){
        Yii::app()->session['user'] = json_encode($userVO);
    }
    
    /**
     * 給予登入者資料
     * @return mixed
     */
    public static function getLogin(){
        return json_decode(Yii::app()->session['user']);
    }
    
    /**
     * 確認目前是否登入
     * @return boolean
     */
    public static function isLogin(){
        return (
                isset(Yii::app()->session['user']) && 
                json_decode(Yii::app()->session['user']) !== false
            );
    }
    
    public static function logout(){
        unset(Yii::app()->session['user']);
    }
    
}