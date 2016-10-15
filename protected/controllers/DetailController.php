<?php
class DetailController extends FrameController
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
        $detailManager = new DetailManager;
        $detailGroupPage = $detailManager->findUserGroupList($userVO, $pageVO);
        
        $this->BreadCrumbs['last'] = '帳務系統';
        
        $this->pageTitle = '帳務系統';
        
        $this->setJS('/js/detail/index.js');
        
        $this->layout('detail/index', array(
            'detailGroupVOList' => $detailGroupPage->detailGroupVOList,
            'pageVO' => $detailGroupPage->pageVO
        ));
    }
    
    /**
     * 群組成員列表頁
     * @param integer $group
     */
    public function actionMember($group){
        $detailManager = new DetailManager;
        
        $userVO = UserManager::getLogin();
        $detailGroupVO = $detailManager->findUserGroup($userVO, $group);
        
        if(empty($detailGroupVO)){
            $this->actionErrorPage();
        }
        
        $status = true;
        
        if(isset($_POST['member'])){
            try {
                $detailManager = new DetailManager;
                $status = $detailManager->doAddGroupMember($group, $_POST['member']);
                
                if($status === true){
                    $this->redirect(Yii::app()->request->baseUrl.sprintf('/detail/member?group=%d', $group));
                }
                
            }catch (DetailException $e){
                $this->actionErrorPage();
            }
        }
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/detail/'] = '帳務系統';
        $this->BreadCrumbs['last'] = '編輯群組：'.$detailGroupVO->title;
        
        $this->pageTitle = '帳務系統：群組成員列表';
        
        $this->layout('detail/member', array(
            'detailGroupVO' => $detailGroupVO,
            'status' => $status
        ));
    }
    
    /**
     * 刪除群組成員 cgi
     * @param unknown $group
     * @param unknown $member
     */
    public function actionDeleteMember($group, $member){
        $userVO = UserManager::getLogin();
        if(isset($_GET['member'], $_GET['group'])){
            try {
                $detailManager = new DetailManager;
                $detailManager->doDelGroupMember($userVO, $group, $member);
                $this->redirect(Yii::app()->request->baseUrl.sprintf('/detail/member?group=%d', $group));
            }catch (DetailException $e){
                $this->actionErrorPage();
            }
        }
    }
    
    /**
     * 群組明細列表頁
     * @param integer $group
     */
    public function actionList($group){
        //$_SERVER['QUERY_STRING']
        $pageVO = new PageVO;
        $pageVO->page = intval($_GET['p']);
        $pageVO->limit = 15;
        $userVO = UserManager::getLogin();
        $detailManager = new DetailManager;
        
        $detailGroupVO = $detailManager->getOwnerGroup($userVO, $group);
        
        if($detailGroupVO === false){
            $this->actionErrorPage();
        }
        
        $members = $detailManager->findGroupMember($group);
        if(!empty($members)){
            foreach ($members as $member){
                $detailGroupVO->members[$member->userId] = $member;
            }
        }
        
        $detailListSearchVO = $this->processListVariable();
        
        $detailListFormVO = $detailManager->getDetailList($group, $detailListSearchVO, $pageVO);
        
        $detailListFormVO->detailGroup = $detailGroupVO;
        
        $detailListFormVO->pageVO->params = $_GET;
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/detail/'] = '帳務系統';
        
        $this->BreadCrumbs['last'] = '群組明細：'.$detailGroupVO->title;
        
        $this->pageTitle = '帳務系統：群組明細列表';
        
        $this->setCSS('/js/jquery/jquery-ui-1.10.3.custom/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        
        $this->setJS('/js/jquery/jquery.blockUI.js');
        
        $this->setJS('/js/detail/list.js');
        
        $_get_uri_params = $_GET;
        unset($_get_uri_params['sort']);
        unset($_get_uri_params['rsort']);
        unset($_get_uri_params['field']);
        $_get_uri_params = $detailManager->getUrlEncodeParamString($_get_uri_params);
        
        $this->layout('detail/list', array(
            'detailListFormVO' => $detailListFormVO,
            'detailListSearchVO' => $detailListSearchVO,
            '_get_uri_params' => $_get_uri_params,
        ));
    }
    
    public function processListVariable(){
        $detailListSearchVO = new DetailListSearchVO;
        if($_GET['time'] == 2 && $_GET['start']!='' && $_GET['end']!=''){
            $detailListSearchVO->time = 2;
            $detailListSearchVO->start = $_GET['start'];
            $detailListSearchVO->end = $_GET['end'];
        }else if($_GET['time'] == 1 && $_GET['year'] != '' && $_GET['month'] != ''){
            $detailListSearchVO->time = 1;
            $detailListSearchVO->year = $_GET['year'];
            $detailListSearchVO->month = $_GET['month'];
        }else{
            $detailListSearchVO->time = 0;
        }
        if($_GET['receipt']!=''){
            $detailListSearchVO->receipt = trim($_GET['receipt']);
        }
        if(isset($detailListSearchVO->sortFieldType[$_GET['field']]))
        {
            $detailListSearchVO->field = $_GET['field'];
        }
        else
        {
            $detailListSearchVO->field = 'date';;
        }
        if(isset($detailListSearchVO->sortType[$_GET['sort']]))
        {
            $detailListSearchVO->sort = $_GET['sort'];
            $detailListSearchVO->rsort = $detailListSearchVO->sortType[$_GET['sort']];
        }
        else
        {
            $detailListSearchVO->sort = 'd';
            $detailListSearchVO->rsort = 'a';
        }
        $detailListSearchVO->ownerId = intval($_GET['ownerId']);
        
        return $detailListSearchVO;
    }
    
    public function actionAdd($group){
        $userVO = UserManager::getLogin();
        $detailManager = new DetailManager;
        
        $detailGroupVO = $detailManager->getOwnerGroup($userVO, $group);
        
        if($detailGroupVO === false){
            $this->actionErrorPage();
        }
        
        if($detailVO = $this->processAddVariable()){
            $detailVO->userId = $userVO->userId;
            
            $detailManager = new DetailManager;
            $detailManager->add($detailVO);
            
            $this->redirect(Yii::app()->request->baseUrl.sprintf('/detail/list?group=%d', $detailVO->groupId));
        }
        
        $groupMemberList = $detailManager->findGroupMember($group);
        
        $this->setCSS('/js/jquery/jquery-ui-1.10.3.custom/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        
        $this->setJS('/js/detail/add.js');
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/detail/'] = '帳務系統';
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.sprintf('/detail/list/?group=%d', $group)] = '群組明細：'.$detailGroupVO->title;
        
        $this->BreadCrumbs['last'] = '新增明細';
        
        $this->pageTitle = '帳務系統：新增群組明細列表';
        
        $this->layout('detail/add', array(
            'detailGroupVO' => $detailGroupVO,
            'groupMemberList' => $groupMemberList
        ));
    }
    
    public function actionEdit($detail){
        
        $userVO = UserManager::getLogin();
        
        $detailManager = new DetailManager;
        
        $detailVO = $detailManager->getDetail($detail);
        
        if(empty($detailVO) || $detailVO->userId!=$userVO->userId){
            $this->actionErrorPage();
        }
        
        $detailGroupVO = $detailManager->getOwnerGroup($userVO, $detailVO->groupId);
        
        if($detailGroupVO === false){
            $this->actionErrorPage();
        }
        
        if(($editDetailVO = $this->processAddVariable()) && $detailVO->detailId == $editDetailVO->detailId){
            $detailManager = new DetailManager;
            $detailManager->edit($editDetailVO);
            
            $this->redirect(Yii::app()->request->baseUrl.sprintf('/detail/list?group=%d', $detailVO->groupId));
        }
        
        $groupMemberList = $detailManager->findGroupMember($detailGroupVO->groupId);
        
        $this->setCSS('/js/jquery/jquery-ui-1.10.3.custom/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        
        $this->setJS('/js/detail/add.js');
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/detail/'] = '帳務系統';
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.sprintf('/detail/list/?group=%d', $detailGroupVO->groupId)] = '群組明細：'.$detailGroupVO->title;
        
        $this->BreadCrumbs['last'] = '編輯明細';
        
        $this->pageTitle = '帳務系統：編輯群組明細列表';
        
        $this->layout('detail/add', array(
            'detailGroupVO' => $detailGroupVO,
            'detailVO' => $detailVO,
            'groupMemberList' => $groupMemberList
        ));
    }

    public function actionDel($group, $detail){
        $userVO = UserManager::getLogin();
        
        $detailManager = new DetailManager;
    
        $detailGroupVO = $detailManager->getOwnerGroup($userVO, $group);
        
        if($detailGroupVO === false){
            $this->actionErrorPage();
        }
        $detailManager->del($userVO, $detail);
        $this->redirect(Yii::app()->request->baseUrl.sprintf('/detail/list?group=%d', $detailGroupVO->groupId));
    }
    
    /**
     * 給予新增的 DetailVO
     * @return NULL|DetailVO
     */
    private function processAddVariable(){
        if(!isset($_POST['groupId'], $_POST['title'], $_POST['credit'])){
            return null;
        }
        $detailVO = new DetailVO;
        $detailVO->detailId = intval($_POST['detailId']);
        $detailVO->title = trim($_POST['title']);
        $detailVO->groupId = intval($_POST['groupId']);
        
        if($_POST['credit'] == 1){
            $detailVO->isCredit = 1;
            $detailVO->credit = intval($_POST['money']);
            $detailVO->debit = 0;
        }else{
            $detailVO->isCredit = 0;
            $detailVO->debit = intval($_POST['money']);
            $detailVO->credit = 0;
        }
        $detailVO->receiptMemo = trim($_POST['memo']);
        $detailVO->owner = intval($_POST['owner']);
        $detailVO->receipt = trim($_POST['receipt']);
        $detailVO->receiptDate = trim($_POST['receiptDate']);
        return $detailVO;
    }
    
    /**
     * 新增群組頁
     */
    public function actionAddGroup(){
        $userManager = new UserManager;
        
        if(!$userManager->isLogin()){
            $this->actionloginPage();
        }
        
        $userVO = $userManager->getLogin();
        
        if(isset($_POST['title'])){
            try {
                $detailManager = new DetailManager;
                $detailManager->doAddGroup($userVO, $_POST['title']);
                $this->actionIndexPage();
            }catch (DetailException $e){
                $this->actionErrorPage();
            }
        }
        
        $this->setJS('/js/detail/addGroup.js');
        
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/detail/'] = '帳務系統';
        
        $this->BreadCrumbs['last'] = '新增群組';
        
        $this->pageTitle = '帳務系統：新增群組';
        
        $this->layout('detail/addGroup');
    }
    
    /**
     * 編輯群組頁
     */
    public function actionEditGroup($group){
        $userManager = new UserManager;
    
        if(!$userManager->isLogin()){
            $this->actionloginPage();
        }
    
        $userVO = $userManager->getLogin();
    
        if(isset($_POST['title'])){
            try {
                $detailManager = new DetailManager;
                $detailManager->doEditGroup($userVO, $group, $_POST['title']);
                $this->actionIndexPage();
            }catch (DetailException $e){
                $this->actionErrorPage();
            }
        }
        
        $this->setJS('/js/detail/addGroup.js');
    
        $this->BreadCrumbs[Yii::app()->request->baseUrl.'/detail/'] = '帳務系統';
    
        $this->BreadCrumbs['last'] = '編輯群組名稱';
    
        $this->pageTitle = '帳務系統：編輯群組名稱';
    
        $this->layout('detail/addGroup', array('group' => $group));
    }
    
    public function actionDelGroup($group){
        $userManager = new UserManager;
        
        if(!$userManager->isLogin()){
            $this->actionloginPage();
        }
        
        $userVO = UserManager::getLogin();
        
        $detailManager = new DetailManager;
        
        try {
            $detailManager->doDelGroup($userVO, $group);
            $this->actionIndexPage();
        }catch (DetailException $e){
            $this->actionErrorPage();
        }
    }
    
    public function actionloginPage(){
        $this->redirect(Yii::app()->request->baseUrl.'/user/');
    }
    
    public function actionIndexPage(){
        $this->redirect(Yii::app()->request->baseUrl.'/detail/');
    }
    
    public function actionDownload(){
        set_time_limit(0);
        /*for($i = 1; $i<24; $i++){
            $createDir = dirname(__FILE__).'/album/'.$i.'/';
            $content = file_get_contents(dirname(__FILE__).'/album/'.$i.'.txt');
            if(!file_exists($createDir)){
                mkdir($createDir);
            }
            $photos = explode("\n", $content);
            foreach ($photos as $photo){
                $this->download($createDir, $photo);
            }
        }*/
        $i = 32764;
        $createDir = dirname(__FILE__).'/album/'.$i.'/';
        $content = file_get_contents(dirname(__FILE__).'/album/'.$i.'.txt');
        if(!file_exists($createDir)){
            mkdir($createDir);
        }
        $photos = explode("\n", $content);
        foreach ($photos as $photo){
            echo $photo."<br/>";
            $this->download($createDir, $photo);
        }
    }
    
    private function download($createDir, $photo){
        if($photo != '' ){
            $path = parse_url($photo);
            $file = pathinfo($path['path']);
            $fp = fopen ($createDir.$file['basename'], 'w+');
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_URL, $photo);
            curl_setopt($ch, CURLOPT_HEADER,0);
            $response = curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }
    }
    
}