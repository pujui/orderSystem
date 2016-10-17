<div style="text-align: right;" >
<input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" value="建立訂單" />
</div>
<br/><br/>

<form method="get">
    <table class="detail-list" width="770">
        <tr>
            <th colspan="2">搜尋條件</th>
        </tr>
        <tr>
            <td>
                <div>
                    <input type="text" name="start" value="" readonly="readonly" placeholder="開始 <?=date('Y-m-d') ?>" />
                    <input type="text" name="end" value="" readonly="readonly" placeholder="結束 <?=date('Y-m-d') ?>" />
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="搜尋" />
                <input type="button" value="返回列表" onclick="location.href='?'"/>
            </td>
        </tr>
    </table>
</form>
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
        <th>訂單內容</th>
        <th>總價錢</th>
        <th >處理狀態</th>
        <th >建立時間</th>
        <th >更新時間</th>
    </tr>
    <?php foreach ($orderListPage->details as $key=>$row){ ?>
    <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?>>
        <td><?=CHtml::encode($row->orderId) ?></td>
        <td style="text-align: center; padding: 0px; margin: 0px;">
            <a href="javascript:void(0);" onclick="$(this).parent().find('table').toggle();">詳細內容</a>
            <table style="padding: 0px; margin: 0px;" class="hide">
            <?php foreach ($row->details as $detailRow){ ?>
                <tr>
                    <td style="text-align: right; padding: 0px; margin: 0px;" ><?=CHtml::encode($detailRow['memo']) ?></td>
                    <td style="text-align: right; padding: 0px; margin: 0px;" >
                        <?=$detailRow['price'] . '&nbsp;x&nbsp;' . $detailRow['itemCount'] . '&nbsp;=&nbsp;' . $detailRow['itemTotal'] ?>
                    </td>
                </tr>
            <?php } ?>
            </table>
        </td>
        <td><?=$row->priceTotal ?></td>
        <td><?=$statusList[$row->status] ?></td>
        <td><?=$row->createTime ?></td>
        <td>
            <?=$row->updateTime ?>
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