<div style="text-align: right;" >
    <input type="button" value="新增明細" onclick="location.href='<?=Yii::app()->request->baseUrl ?>/detail/add?group=<?=$detailListFormVO->detailGroup->groupId; ?>';" />
</div>
<?php
if(!empty($detailListFormVO->memberGroup)){
    include dirname(__FILE__).'/list/members.php';
}
if(!empty($detailListFormVO->years)){
    include dirname(__FILE__).'/list/years.php';
}
if(!empty($detailListFormVO->months)){
    include dirname(__FILE__).'/list/months.php';
}
?>
<table class="detail-list">
    <tr>
        <th style="width: 100px; ">統計數據</th>
        <td style="text-align: left; vertical-align: middle; padding-left: 10px;">
            <? if(!empty($detailListFormVO->memberGroup)){ ?>
            <a href="javascript:void(0);" id="groupTotalBtn" >個人帳務統計</a>&nbsp;
            <? }else{ ?>
            個人帳務統計
            <? } ?>
            &nbsp;/&nbsp;
            <? if(!empty($detailListFormVO->months)){ ?>
            <a href="javascript:void(0);" id="monthsTotalBtn" >月統計</a>&nbsp;
            <? }else{ ?>
            前後月統計
            <? } ?>
            &nbsp;/&nbsp;
            <? if(!empty($detailListFormVO->years)){ ?>
            <a href="javascript:void(0);" id="yearsTotalBtn" >年統計</a>&nbsp;
            <? }else{ ?>
            前後年統計
            <? } ?>
        </td>
    </tr>
</table>
<form method="get">
    <table class="detail-list">
        <tr>
            <th colspan="2">搜尋條件</th>
        </tr>
        <tr>
            <td style="text-align: center; width: 50px; vertical-align: middle;">發票日期</td>
            <td style="text-align: left;" >
                <div>
                    <input type="radio" name="time" value="0" checked />無
                </div>
                <div>
                    <input type="radio" name="time" value="1" />
                    <select name="year">
                        <?php for($i = date('Y'); $i >= 2012; $i--){ ?>
                        <option value="<?=$i ?>" ><?=$i ?></option>
                        <?php } ?>
                    </select>&nbsp;年
                    <select name="month" >
                        <?php for($i = 12; $i >= 1; $i--){ ?>
                        <option value="<?=sprintf('%02d', $i) ?>" ><?=sprintf('%02d', $i) ?></option>
                        <?php } ?>
                    </select>&nbsp;月&nbsp;&nbsp;
                </div>
                <div>
                    <input type="radio" name="time" value="2" />
                    <input type="text" name="start" value="" readonly="readonly" placeholder="開始 <?=date('Y-m-d') ?>" />
                    <input type="text" name="end" value="" readonly="readonly" placeholder="結束 <?=date('Y-m-d') ?>" />
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; width: 50px; vertical-align: middle;">發票號碼</td>
            <td style="text-align: left;" >
                <input type="text" name="receipt" value="" placeholder="發票號碼  XF-12345678" />
            </td>
        </tr>
        <tr>
            <td style="text-align: center; width: 50px; vertical-align: middle;">帳務歸屬</td>
            <td style="text-align: left;">
                <select name="ownerId" >
                    <option value="0">全部</option>
                    <option value="-1">無</option>
                    <?php foreach ($detailListFormVO->detailGroup->members as $ownerId=>$member){ ?>
                    <option value="<?=$ownerId ?>" ><?=$member->user->account ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="group" value="<?=$detailListFormVO->detailGroup->groupId; ?>" />
                <input type="hidden" name="field" value="<?=$detailListSearchVO->field; ?>" />
                <input type="hidden" name="sort" value="<?=$detailListSearchVO->sort; ?>" />
                <input type="submit" value="搜尋" />
                <input type="button" value="返回列表" onclick="location.href='?group=<?=$detailListFormVO->detailGroup->groupId; ?>'"/>
            </td>
        </tr>
    </table>
</form>
<br/><br/>
<? if(empty($detailListFormVO->details)){ ?>
<table class="detail-list">
    <tr>
        <th>無資料</th>
    </tr>
</table>
<? }else{ ?>
<table class="detail-list">
    <tr>
        <th><a href="?<?=$_get_uri_params ?>&amp;field=date&amp;sort=<?=$detailListSearchVO->rsort ?>">日期</a></th>
        <th><a href="?<?=$_get_uri_params ?>&amp;field=name&amp;sort=<?=$detailListSearchVO->rsort ?>">名稱</a></th>
        <th><a href="?<?=$_get_uri_params ?>&amp;field=credit&amp;sort=<?=$detailListSearchVO->rsort ?>">入帳</a></th>
        <th><a href="?<?=$_get_uri_params ?>&amp;field=debit&amp;sort=<?=$detailListSearchVO->rsort ?>">出帳</a></th>
        <th><a href="?<?=$_get_uri_params ?>&amp;field=owner&amp;sort=<?=$detailListSearchVO->rsort ?>">帳務歸屬</a></th>
        <th>備註</th>
        <th><a href="?<?=$_get_uri_params ?>&amp;field=ct&amp;sort=<?=$detailListSearchVO->rsort ?>">建立時間</a></th>
        <th><a href="?<?=$_get_uri_params ?>&amp;field=ut&amp;sort=<?=$detailListSearchVO->rsort ?>">更新時間</a></th>
        <th></th>
    </tr>
    <?php foreach ($detailListFormVO->details as $key=>$row){ ?>
    <tr <? if($key%2 == 1){ ?>class="odd-row" <? } ?>>
        <td>
            <?=$row->receiptDate ?>
            <?php if( $row->receipt!='' ){ ?>
            <div><?=$row->receipt ?></div>
            <?php }?>
        </td>
        <td><?=CHtml::encode($row->title) ?></td>
        <td><?=number_format($row->credit) ?></td>
        <td><?=number_format($row->debit) ?></td>
        <td>
        <?
        if(isset($detailListFormVO->detailGroup->members[$row->owner])){
            echo $detailListFormVO->detailGroup->members[$row->owner]->user->account;
        }
        ?>
        </td>
        <td><?=CHtml::encode($row->receiptMemo) ?></td>
        <td><?=$row->createtime ?></td>
        <td><?=$row->updatetime ?></td>
        <td>
            <?php if($row->userId == $user->userId){ ?>
            <a href="<?=Yii::app()->request->baseUrl.sprintf('/detail/del?group=%d&amp;detail=%d', $row->groupId, $row->detailId); ?>" class="delDetail" >刪除</a>
            &nbsp;|&nbsp;
            <a href="<?=Yii::app()->request->baseUrl.sprintf('/detail/edit?detail=%d', $row->detailId); ?>">編輯</a>
            <?php } ?>
        </td>
    </tr>
    <?php }?>
</table>
<? } ?>
<?php 
$this->widget('CPageView',array(
        'pageVO' => $detailListFormVO->pageVO
));
?>
<script type="text/javascript">
    var detailListSearchVO = <?=json_encode($detailListSearchVO); ?>;
</script>