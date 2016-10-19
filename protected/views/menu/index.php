<div id="tabs">
    <ul>
        <li><a href="#tabs-1">菜單列表</a></li>
        <li style="width: 650px; text-align: right;">
            <input type="button" class="templeBtn3" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/menu/add';" value="建立商品" />
        </li>
        <li><input type="button" class="templeBtn3" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/menu/extra';" value="編輯例外選項" /></li>
    </ul>
    <div id="tabs-1">
        <?php if(empty($menuListPage->details)){ ?>
        <table class="detail-list" width="900">
            <tr>
                <th>無資料</th>
            </tr>
        </table>
        <?php }else{ ?>
        <table class="detail-list" width="900" >
            <tr>
                <th>分類</th>
                <th>商品</th>
                <th>項目</th>
                <th>狀態</th>
                <th>建立時間</th>
                <th></th>
            </tr>
            <?php foreach ($menuListPage->details as $key=>$row){ ?>
            <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?> >
                <td><?=CHtml::encode($row->firstClass) ?></td>
                <td><?=CHtml::encode($row->name) ?></td>
                <td style="text-align: left; padding-left: 20px;">
                <?php
                $priceList = [];
                $classNo = 1;
                foreach($row->classPrice as $class_row){
                    if(!empty($class_row[0]) && $class_row[1] > 0){
                        echo CHtml::encode($class_row[0]).'&nbsp;&nbsp;價格:&nbsp;'.$class_row[1].'<br/>';
                        $classNo++;
                    }
                }
                ?></td>
                <td><?=$sellStatusList[$row->isCancel] ?></td>
                <td><?=$row->createTime ?></td>
                <td>
                    <?=$row->updateTime ?><br/>
                    <input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/menu/edit/?id=<?=$row->menuId ?>';" value="編輯" />
                </td>
            </tr>
            <?php }?>
        </table>
        <?php } ?>
        <br/>
        <?php
        $this->widget('CPageView',array(
            'pageVO' => $menuListPage->pageVO
        ));
        ?>
    </div>
</div>