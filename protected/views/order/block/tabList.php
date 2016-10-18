<form method="get">
    <table class="detail-list" width="770">
        <tr>
            <td>
                <div>
                    處理狀態：<select name="status" >
                        <option value="0" >全部</option>
                        <option value="1" <?php if($orderListPage->pageVO->params['status'] == '1'){ ?>selected="selected"<?php } ?>>未處理</option>
                        <option value="2" <?php if($orderListPage->pageVO->params['status'] == '2'){ ?>selected="selected"<?php } ?>>已處理</option>
                    </select>
                    <input type="text" name="start" value="<?=CHtml::encode($orderListPage->pageVO->params['start']) ?>" readonly="readonly" placeholder="開始 <?=date('Y-m-d') ?>" />
                    <input type="text" name="end" value="<?=CHtml::encode($orderListPage->pageVO->params['end']) ?>" readonly="readonly" placeholder="結束 <?=date('Y-m-d') ?>" />
                    <input type="submit" value="搜尋" />
                    <input type="button" value="預設搜尋" onclick="location.href='?'"/>
                </div>
            </td>
        </tr>
    </table>
</form>
<table class="detail-list" width="770">
    <tr>
        <td>查詢結果</td>
        <td colspan="3">
            查詢訂單數:&nbsp;<?=$orderListPage->pageVO->total ?>，總金額:<?=$orderListPage->pageVO->price ?>，目前第<?=(!$orderListPage->pageVO->page)? 1: $orderListPage->pageVO->page ?>頁
        </td>
    </tr>
</table>
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
        <th >建立&更新時間</th>
    </tr>
    <?php foreach ($orderListPage->details as $key=>$row){ ?>
    <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?>>
        <td><?=CHtml::encode($row->todayOrderNo) ?></td>
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
        <td>
            <?php if($row->status == 0){ ?>
                <input type="button" onclick="if(confirm('確認是否標示已處理')) location.href='<?=Yii::app()->request->baseUrl; ?>/order/edit?id=<?=$row->orderId ?>&s=1';" value="已處理訂單" />
                <input type="button" onclick="if(confirm('確認是否取消, 取消後無法回復')) location.href='<?=Yii::app()->request->baseUrl; ?>/order/edit?id=<?=$row->orderId ?>&s=2';" value="取消訂單" />
            <?php }else{ ?>
                <?=$statusList[$row->status] ?>
            <?php } ?>
            
        </td>
        <td>
            <?=date('Y-m-d H:i', strtotime($row->createTime)) ?>
            <?php if($row->status != 0){ ?><br/>
            <?=date('Y-m-d H:i', strtotime($row->updateTime)) ?>
            <?php } ?>
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