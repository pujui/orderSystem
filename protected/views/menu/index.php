
<div style="text-align: right;" >
    <input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/menu/add';" value="建立商品" />
</div>
<br/><br/>
<?php if(empty($menuListPage->details)){ ?>
<table class="detail-list">
    <tr>
        <th>無資料</th>
    </tr>
</table>
<?php }else{ ?>
<table class="detail-list">
    <tr>
        <th>分類</th>
        <th>商品名</th>
        <th >項目</th>
        <th>販賣狀態</th>
        <th>建立時間</th>
        <th></th>
    </tr>
    <?php foreach ($menuListPage->details as $key=>$row){ ?>
    <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?>>
        <td><?=CHtml::encode($row->firstClass) ?></td>
        <td><?=CHtml::encode($row->name) ?></td>
        <td style="text-align: left;">
        <?php
        $priceList = [];
        $classNo = 1;
        foreach($row->classPrice as $class_row){
            if(!empty($class_row[0]) && $class_row[1] > 0){
                echo $classNo.'.&nbsp;'.CHtml::encode($class_row[0]).'&nbsp;&nbsp;價格:&nbsp;'.$class_row[1].'<br/>';
                $classNo++;
            }
        }
        ?></td>
        <td><?=$row->isCancel ?></td>
        <td><?=$row->createTime ?></td>
        <td>
            <?=$row->updateTime ?><br/>
            <input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/menu/edit/?id=<?=$row->menuId ?>';" value="編輯" />
        </td>
    </tr>
    <?php }?>
</table>
<?php } ?>
<?php
$this->widget('CPageView',array(
    'pageVO' => $menuListPage->pageVO
));
?>