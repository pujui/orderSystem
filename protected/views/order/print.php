<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="zh" />
    <script type="text/javascript" src="/orderSystem/js/jquery/jquery-1.9.1.min.js"></script>
    <style type="text/css">
    body{
        margin: 1px; 
    }
    @page { margin: 0px; }
    .cFristPrint{
        padding: 0px; 
        margin: 0px; 
        width: 120px; 
        height: 94px; 
        overflow: hidden;
    }
    .cPrint{
        padding: 0px; 
        margin: 0px; 
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
        width: 65px;
        height: 15px; 
        font-size: 12px;
    }
    .printAttrB{
        width: 65px;
        height: 28px; 
        font-size: 12px;
        overflow: hidden;
    }
    .printNo{
        height: 20px; 
        width: 65px;
        font-size: 16px;
        padding-left: 20px;
    }
    .printPrice{
        position: absolute;
        left: 80px;
        font-size: 16px;
    }
    </style>
</head>
<body>
<?php
// 1mm = 3.78px
$orderNo = explode('O', $order->todayOrderNo);
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
    <div class="<?php echo ($k == 0)? 'cFristPrint': 'cPrint'; ?>">
        <div class="printName"  ><?=$itemName; ?></div><div class="printPrice" >$<?=$detailRow['price']; ?></div>
        <div class="printAttrA" ><?=$itemAttrA; ?></div>
        <div class="printAttrB" ><?=implode('<br/>', $itemAttrB); ?></div>
        <div class="printNo" >No. <?=sprintf(' %d', $orderNo[1]); ?></div>
    </div>
<?php
}
?>
    <script type="text/javascript">
        $(document).ready(function(){
            window.print();
            setTimeout(loaction_href, 1500);
        });
        function loaction_href(){
            location.href = "<?=Yii::app()->request->baseUrl.'/order/'; ?>";
        }
    </script>
</body>
</html>