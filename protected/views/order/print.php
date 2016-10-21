<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="zh" />
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl . '/css/print.css'?>" />
    <script type="text/javascript" src="/orderSystem/js/jquery/jquery-1.9.1.min.js"></script>
</head>
<body>
<?php 
// 1mm = 3.78px
$orderNo = explode('O', $order->todayOrderNo);
if($tp == 1){
    $firstCheck = 0;
    foreach ($order->details as $k => $detailRow){
        $item = explode(' ', $detailRow['memo']);
        $itemName = $itemAttrA = '';
        $itemAttrB = [];
        foreach ($item as $itemKey=>$itemValue){
            if($itemKey == 0){
                $itemName = CHtml::encode($itemValue);
            }else  if($itemKey == 1){
                $itemAttrA = CHtml::encode($itemValue);
            }else{
                $itemAttrB[] = CHtml::encode($itemValue);
            }
        }
        for($i = 0; $i < $detailRow['itemCount']; $i++){
    ?>
    <div class="<?php echo ($firstCheck == 0)? 'cFristPrint': 'cPrint'; ?>">
        <div class="printName"  ><?=$itemName; ?></div>
        <div class="printAttrA" ><?=$itemAttrA; ?></div>
        <div class="printAttrB">
            <table>
                <tr>
                    <td class="printAttrB-F"><?=implode('<br/>', $itemAttrB); ?></td>
                    <td class="printAttrB-S" >$<?=$detailRow['price']; ?></td>
                </tr>
            </table>
        </div>
        <div class="printNo" >No. <?=sprintf(' %d', $orderNo[1]); ?></div>
    </div>
    <?php
            $firstCheck = 1;
        }
    }
} else {
?>
    <div class="printOrder" >
        <div class="printOrderTitle">果食&nbsp;&nbsp;-&nbsp;&nbsp;訂單號碼：<?=sprintf(' %d', $orderNo[1]); ?></div>
        
        <div class="printOrderBody">
    <?php 
    foreach ($order->details as $k => $detailRow){
        $item = explode(' ', $detailRow['memo']);
        $itemName = $itemAttrA = '';
        $itemAttrB = [];
        foreach ($item as $itemKey=>$itemValue){
            if($itemKey == 0){
                $itemName = CHtml::encode($itemValue);
            }else  if($itemKey == 1){
                $itemAttrA = CHtml::encode($itemValue);
            }else{
                $itemAttrB[] = CHtml::encode($itemValue);
            }
        }
    ?>
        <div>
            <span class="pob1" ><?=$itemName; ?></span>
            <span class="pob2" ><?=$itemAttrA; ?></span>
            <span class="pob3" ><?=implode('', $itemAttrB); ?></span>
        </div>
        <div style="text-align: right;">
            <span class="pob4" >*<?=$detailRow['itemCount']; ?></span>
            <span class="pob5" >$<?=$detailRow['price']; ?></span>
        </div>
    <?php
    }
    ?>
        </div>
        <div class="printOrderPrice">總計：$<?=$order->priceTotal?></div>
        <div class="printOrderTime"><?=date('Y/m/d H:i',strtotime($order->createTime))?></div>
    </div>
<?php
}
?>
    <script type="text/javascript">
        $(document).ready(function(){
            window.print();
            setTimeout(loaction_href, 1000);
        });
        function loaction_href(){
            <?php 
            if($only == 1){
                echo sprintf('alert("列印完成");location.href ="%s/order/";'
                        , Yii::app()->request->baseUrl
                );
            }else if($tp == 1){
                echo sprintf('alert("商品標籤列印完成");location.href ="%s/order/";'
                        , Yii::app()->request->baseUrl
                );
            }else{
                echo sprintf('alert("明細列印完成");location.href ="%s/order/print?id=%d&tp=1";'
                        , Yii::app()->request->baseUrl
                        , $order->orderId
                );
            }
            ?>
        }
    </script>
</body>
</html>