<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="zh" />
    <style type="text/css">@CHARSET "UTF-8";
body{
    margin: 1px; 
}
@page { margin: 0px; }
.cFristPrint{
    padding: 0px; 
    margin: 0px; 
    margin-left: 2px;
    width: 120px; 
    height: 94px; 
    overflow: hidden;
}
.cPrint{
    padding: 0px; 
    margin: 0px; 
    margin-left: 2px;
    width: 120px; 
    height: 94px; 
    overflow: hidden;
    page-break-before: always; 
}
.cPrint div{
    /*border:#ccc 1px solid; */
    margin: 1px;
    overflow: hidden;
}
.printName{
    width: 110px; 
    height: 20px; 
    font-size: 16px;
}
.printAttrA{
    padding-left: 2px;
    width: 65px;
    height: 15px; 
    font-size: 12px;
}
.printAttrB{
    padding: 0px; 
    width: 120px; 
    height: 48px; 
    overflow: hidden;
    text-align: left;
}

.printAttrB table, tr, td, tbody{
    padding: 0px; 
    margin: 0px; 
    border: 0px;
    text-align: left;
    vertical-align: top;
}
.printAttrB .printAttrB-F{
    width: 100px; 
    font-size: 12px;
    over-flow: hidden; 
    height: 15px;
}
.printAttrB .printAttrB-S{
    width: 100px; 
    font-size: 14px;
}
.printOrder{
    width: 215px;
    margin-left: 2px;
}
.printOrderTitle{
    width: 200px;
    border-bottom:#ccc 1px solid;
    padding: 5px; 
    margin: 0px;
    font-weight:bold;
    font-size: 18px;
}
.printOrderBody{
    padding: 2px; 
    width: 206px;
    overflow-x: hidden;
}
.pob1{
    font-size: 16px;
    padding-right: 15px;
    font-weight:bold;
}
.pob2 , .pob3, .pob4, .pob5{
    font-size: 14px;
}
.pob4{
    padding-right: 20px;
}
.printOrderPrice{
    border-top:#ccc 1px solid;
    width: 206px;
    height: 30px;
    padding-top: 12px; 
    padding-left: 2px; 
    padding-right: 2px; 
    font-size: 18px;
    text-align: right;
    font-weight:bold;
}
.printOrderTime{
    height: 30px;
    width: 206px;
    padding: 2px; 
}
    </style>
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
            }else if($itemKey < 4){
                $itemAttrB[] = '<div class="printAttrB-F" >'.CHtml::encode($itemValue).'</div>';
            }
        }
        for($i = 0; $i < $detailRow['itemCount']; $i++){
    ?>
    <div class="<?php echo ($firstCheck == 0)? 'cFristPrint': 'cPrint'; ?>">
        <div class="printName"  ><?=$itemName; ?></div>
        <div class="printAttrA" ><?=$itemAttrA; ?></div>
        <div class="printAttrB">
            <?=implode('', $itemAttrB); ?>
            <div class="printAttrB-S">
                No.<?=sprintf('%03d', $orderNo[1]); ?>&nbsp;&nbsp;$<?=$detailRow['price']; ?>
            </div>
        </div>
    </div>
    <?php
            $firstCheck = 1;
        }
    }
} else if($tp == 2){
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
if($show == 1){
?>
<script type="text/javascript">
    alert('列印資料已送出');
    location.href = '<?=Yii::app()->request->baseUrl . '/order/'?>';
</script>
<?php } ?>
</body>
</html>