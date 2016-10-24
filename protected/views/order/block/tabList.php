<form id="searchOrderForm" method="get">
    <table class="detail-list searchOrderTable" >
        <tr>
            <td>
                <div>
                    處理狀態：<select name="status btn" >
                        <option value="0" >全部</option>
                        <option value="1" <?php if($orderListPage->pageVO->params['status'] == '1'){ ?>selected="selected"<?php } ?>>已成立</option>
                        <option value="2" <?php if($orderListPage->pageVO->params['status'] == '2'){ ?>selected="selected"<?php } ?>>已取消</option>
                    </select>
                    <input type="text" name="start" value="<?=CHtml::encode($orderListPage->pageVO->params['start']) ?>" readonly="readonly" placeholder="開始 <?=date('Y-m-d') ?>" />
                    <input type="text" name="end" value="<?=CHtml::encode($orderListPage->pageVO->params['end']) ?>" readonly="readonly" placeholder="結束 <?=date('Y-m-d') ?>" />
                    <button type="submit" class="btn btn-default"  >搜尋</button>
                    <button type="button" class="btn btn-default" onclick="location.href='?';" >預設搜尋</button>
                </div>
            </td>
        </tr>
    </table>
</form>
<table class="detail-list searchOrderTable" >
    <tr>
        <td>查詢結果</td>
        <td colspan="3">
            查詢訂單數:&nbsp;<?=$orderListPage->pageVO->total ?>，總金額:<?=$orderListPage->pageVO->price ?>，目前第<?=(!$orderListPage->pageVO->page)? 1: $orderListPage->pageVO->page ?>頁
        </td>
    </tr>
</table>
<?php if(empty($orderListPage->details)){ ?>
<table class="detail-list" >
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
    </tr>
    <?php foreach ($orderListPage->details as $key=>$row){ ?>
    <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?>>
        <td><?=CHtml::encode($row->todayOrderNo) ?></td>
        <td style="text-align: center; padding: 0px; margin: 0px;">
            <a href="javascript:void(0);" onclick="$(this).parent().find('div').toggle();">詳細內容</a>
            <div style="display:none; position: absolute; height: 200px; overflow-y: scroll;" >
                <table style="padding: 0px; margin: 0px; width: 500px;" >
                <?php foreach ($row->details as $detailRow){ ?>
                    <tr class="odd-row">
                        <td style="text-align: left; padding: 10px; margin: 0px; vertical-align: top;" ><?=CHtml::encode($detailRow['memo']) ?></td>
                        <td style="text-align: left; padding: 10px; margin: 0px; vertical-align: top;" >
                            <?=$detailRow['price'] . '&nbsp;x&nbsp;' . $detailRow['itemCount'] . '&nbsp;=&nbsp;' . $detailRow['itemTotal'] ?>
                        </td>
                    </tr>
                <?php } ?>
                </table>
            </div>
        </td>
        <td><?=$row->priceTotal ?></td>
        <td >
            <div  style="padding-top: 10px;">
                <button type="button" class="btn btn-default" onclick="if(confirm('確認列印')) location.href='<?=Yii::app()->request->baseUrl; ?>/order/updatePrint?orderNo=<?=$row->todayOrderNo ?>&id=<?=$row->orderId ?>&tp=2';" >補印明細</button>
                <button type="button" class="btn btn-default" onclick="if(confirm('確認列印')) location.href='<?=Yii::app()->request->baseUrl; ?>/order/updatePrint?orderNo=<?=$row->todayOrderNo ?>&id=<?=$row->orderId ?>&tp=1';" >補印商品標</button>
                <button type="button" class="btn btn-default" onclick="if(confirm('確認列印')) location.href='<?=Yii::app()->request->baseUrl; ?>/order/updatePrint?orderNo=<?=$row->todayOrderNo ?>&id=<?=$row->orderId ?>&tp=3';" >補印訂單</button><br/>
            </div>
            <div  style="padding-top: 10px; padding-bottom: 10px;">
            <?php if($row->status == 0){ ?>
                <button type="button" class="btn btn-default" onclick="if(confirm('確認是否回復訂單')) location.href='<?=Yii::app()->request->baseUrl; ?>/order/edit?id=<?=$row->orderId ?>&s=1';" >回復訂單</button>
            <?php }else{ ?>
                <button type="button" class="btn btn-default" onclick="if(confirm('確認是否取消訂單')) location.href='<?=Yii::app()->request->baseUrl; ?>/order/edit?id=<?=$row->orderId ?>&s=2';" >取消訂單</button>
            <?php } ?>
            <?=$statusList[$row->status] ?>
            </div>
        </td>
        <td>
            <?=date('Y-m-d H:i', strtotime($row->createTime)) ?>
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