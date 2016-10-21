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
            <button type="button" id="sendOrder" class="btn btn-default templeBtn1" data-print="0" >送出訂單</button>
            <button type="button" class="btn btn-default templeBtn1" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" >清除</button><br/>
            <button type="button" id="sendOrderAndPrint" class=" btn btn-default templeBtn2" data-print="1" >列印並送出訂單</button>
        </td>
    </tr>
</table>