<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="zh" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>訂單系統 - 列印訂單<?=$order->todayOrderNo ?></title>
    <script type="text/javascript" src="/orderSystem/js/jquery/jquery-1.9.1.min.js"></script>
</head>
<body>
    <table style="padding: 0px; margin: 0px;" >
        <tr>
            <td><?=$order->todayOrderNo ?></td>
        </tr>
    <?php foreach ($order->details as $detailRow){ ?>
        <tr>
            <td style="text-align: right; padding: 0px; margin: 0px;" >
                <?=sprintf('%s $%d', CHtml::encode($detailRow['memo']), $detailRow['price']) ?>
            </td>
        </tr>
    <?php } ?>
    </table>
    <script type="text/javascript">
        window.print();
        $(document).ready(function(){
            setTimeout(loaction_href, 1500);
        });
        function loaction_href(){
            location.href = "<?=Yii::app()->request->baseUrl.'/order/'; ?>";
        }
    </script>
</body>
</html>