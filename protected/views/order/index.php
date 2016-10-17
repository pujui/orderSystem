<div style="text-align: right;" >
<input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" value="建立訂單" />
</div>
<br/><br/>
<?php if(empty($orderListPage->details)){ ?>
<table class="detail-list">
    <tr>
        <th>無資料</th>
    </tr>
</table>
<?php }else{ ?>
<table class="detail-list">
    <tr>
        <th>訂單號碼</th>
        <th>總價錢</th>
        <th>訂單內容</th>
        <th>處理狀態</th>
        <th>建立時間</th>
        <th></th>
    </tr>
    <?php foreach ($orderListPage->details as $key=>$row){ ?>
    <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?>>
        <td><?=CHtml::encode($row->orderId) ?></td>
        <td><?=$row->priceTotal ?></td>
        <td>訂單內容</td>
        <td><?=$row->status ?></td>
        <td><?=$row->createTime ?></td>
        <td>
            <?=$row->updateTime ?><br/>
            <input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/edit/?id=<?=$row->menuId ?>';" value="編輯" />
        </td>
    </tr>
    <?php }?>
</table>
<?php } ?>
<?php
$this->widget('CPageView',array(
    'pageVO' => $orderListPage->pageVO
));
?>