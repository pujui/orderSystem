<?php
class MenuManager{
    
    public function show(){
        $menuDAO = new MenuDAO();
        $list = $menuDAO->findMenuList(NULL, 'SHOW');
        
        $showList = [];
        foreach ($list as $row){
            if(!isset($showList[$row['firstClass']])){
                $showList[$row['firstClass']] = [];
            }
            $priceList = [];
            for($i=1; $i < 11; $i++){
                if($row['className'.$i] != '' && $row['classPrice'.$i] > 0){
                    $priceList[] = [$row['className'.$i], $row['classPrice'.$i]];
                }
            }
            $row['priceList'] = $priceList;
            $showList[$row['firstClass']][] = $row;
        }
        return $showList;
    }
    
    public function findMenuList($pageVO){
        $menuDAO = new MenuDAO();
        $pageVO->total = $menuDAO->findMenuList($pageVO, 'TOTAL');
        $pageVO->createStartRange();

        $list = $menuDAO->findMenuList($pageVO, 'PAGE');
        $menuListPage = new MenuListPage;
        $menuListPage->pageVO = $pageVO;
        foreach ($list as $row){
            $menuVO = new MenuVO;
            $menuVO->setData($row);
            $menuListPage->details[] = $menuVO;
        }
        return $menuListPage;
    }

    public function add($data){
        $insert = [
            'name' => trim((string)$data['name']),
            'firstClass' => trim((string)$data['firstClass']),
            'defFirstClass' => trim((string)$data['defFirstClass']),
            'isCancel' => (int) $data['isCancel'],
        ];
        if($insert['defFirstClass'] != '-999'){
            $insert['firstClass'] = $insert['defFirstClass'];
        }
        if(in_array('', [$insert['name'], $insert['firstClass']])){
            throw new MenuException(MenuException::ERR_VALUE_IS_EMPTY);
        }
        if(!in_array($insert['isCancel'], [-1, 0, 1])){
            throw new MenuException(MenuException::ERR_VALUE_IS_EMPTY);
        }
        foreach ($data['className'] as $key=>$val){
            $insert['className'.($key+1)] = trim((string) $val);
        }
        foreach ($data['classPrice'] as $key=>$val){
            $insert['classPrice'.($key+1)] = (int) $val;
        }
        $menuDAO = new MenuDAO();
        $menuDAO->add($insert);
    }

    public function edit($id, $data){
        $insert = [
            'name' => trim((string)$data['name']),
            'firstClass' => trim((string)$data['firstClass']),
            'defFirstClass' => trim((string)$data['defFirstClass']),
            'isCancel' => (int) $data['isCancel'],
            'menuId' => (int) $id,
        ];
        if($insert['defFirstClass'] != '-999'){
            $insert['firstClass'] = $insert['defFirstClass'];
        }
        if(in_array('', [$insert['name'], $insert['firstClass']])){
            throw new MenuException(MenuException::ERR_VALUE_IS_EMPTY);
        }
        if(!in_array($insert['isCancel'], [-1, 0, 1])){
            throw new MenuException(MenuException::ERR_VALUE_IS_EMPTY);
        }
        foreach ($data['className'] as $key=>$val){
            $insert['className'.($key+1)] = trim((string) $val);
        }
        foreach ($data['classPrice'] as $key=>$val){
            $insert['classPrice'.($key+1)] = (int) $val;
        }
        $menuDAO = new MenuDAO();
        $menuDAO->edit($insert);
    }

    public function findExtral($option = 0){
        $menuDAO = new MenuDAO;
        $result = $menuDAO->findExtraMenu();
        $list = [];
        foreach ($result as $row){
            if($option == 1 && $row['name']==''){
                continue;
            }
            if(!isset($list[$row['className']])) $list[$row['className']] = [];
            if(in_array($row['className'], ['sugar', 'ice'])){
                $list[$row['className']][] = [$row['name'], $row['selected'], $row['extraId']];
            }else if($row['className'] == 'extra'){
                $list[$row['className']][] = [$row['name'], $row['price'], $row['extraId']];
            }
        }
        return $list;
    }
    
    public function editExtral($data){
        if(empty($data['sugarId'])){
            throw new MenuException(MenuException::ERR_VALUE_IS_EMPTY);
        }
        if(empty($data['iceId'])){
            throw new MenuException(MenuException::ERR_VALUE_IS_EMPTY);
        }
        if(empty($data['extraId'])){
            throw new MenuException(MenuException::ERR_VALUE_IS_EMPTY);
        }
        $menuDAO = new MenuDAO;
        foreach ($data['sugarId'] as $key=>$value){
            $insert = [
                ':extraId' => (int) $value,
                ':name'    => trim((string)$data['sugarName'][$key]),
            ];
            $menuDAO->editExtraMenu($insert, 'sugar');
        }
        foreach ($data['iceId'] as $key=>$value){
            $insert = [
                ':extraId' => (int) $value,
                ':name'    => trim((string)$data['iceName'][$key]),
            ];
            $menuDAO->editExtraMenu($insert, 'ice');
        }
        foreach ($data['extraId'] as $key=>$value){
            $insert = [
                ':extraId' => (int) $value,
                ':name'    => trim((string)$data['extraName'][$key]),
                ':price'    =>(int) $data['extraPrice'][$key],
            ];
            $menuDAO->editExtraMenu($insert, 'extra');
        }
        
    }
}
