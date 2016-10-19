<table id="addOrder">
    <tr>
        <th colspan="2" >訂單內容</th>
    </tr>
    <tr>
        <th style="padding: 5px;" >品項</th><th style="padding: 5px;" >價格&nbsp;x&nbsp;數量</th>
    </tr>
    <tr>
        <td colspan="2" id="addItemBlock" style="text-align: center; padding: 5px;" ></td>
    </tr>
    <tr>
        <th >總價格</th><td colspan="2" id="totalPrice"  >0</td>
    </tr>
    <tr>
        <td colspan="3" >
            <input type="button" id="sendOrder" class="templeBtn1" data-print="0" value="送出訂單" />
            <input type="button" class="templeBtn1" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" value="清除" />
            <br/><input type="button" id="sendOrderAndPrint" data-print="1"  class="templeBtn2"  value="列印並送出訂單" />
        </td>
    </tr>
</table>