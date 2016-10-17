<form id="addOrderForm" method="post" style="height:600px; " >
    <div>
        <div style="float: left; width: 300px;">
            <table style="width: 300px;">
                <tr>
                    <th colspan="2" >訂單內容</th>
                </tr>
                <tr>
                    <th style="padding: 5px;" >品項</th><th style="padding: 5px;" >價格&nbsp;x&nbsp;數量&nbsp;=&nbsp;小計</th>
                </tr>
                <tr>
                    <td colspan="2" id="addItemBlock" style="text-align: center; padding: 5px;" ></td>
                </tr>
                <tr>
                    <th >總價格</th><td colspan="2" id="totalPrice"  >0</td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <input type="submit" style="width: 100px;height: 50px;" value="送出訂單" />
                        <input type="button" style="width: 100px;height: 50px; margin-bottom:10px;" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" value="清除" />
                        <input type="submit" style="width: 200px;height: 50px; margin-bottom:10px;" value="列印並送出訂單" />
                    </td>
                </tr>
            </table>
        </div>
        <div style="float: left; height:600px; overflow:scroll;" >
            <table style="width: 500px;">
                <?php foreach ($showList as $className=>$menuList){ ?>
                <tr>
                    <th colspan="2" ><?=CHtml::encode($className) ?></th>
                </tr>
                    <?php foreach ($menuList as $key=>$row){ ?>
                <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?> >
                    <td ><?=CHtml::encode($row['name']) ?></td>
                    <td style="text-align: left;">
                        <?php foreach ($row['priceList'] as $priceRow){ ?>
                            <?=sprintf('<input type="button" style="height:50px;" 
                                        value="%s : %d" 
                                        class="addItem"
                                        data-nameid="%s"
                                        data-name="%s"
                                        data-classname="%s"
                                        data-price="%d"
                                     />'
                                    , CHtml::encode($priceRow[0]), CHtml::encode($priceRow[1])
                                    , CHtml::encode($row['menuId'])
                                    , CHtml::encode($row['name'])
                                    , CHtml::encode($priceRow[0])
                                    , CHtml::encode($priceRow[1])) 
                            ?>
                        <?php } ?>
                    </td>
                </tr>
                    <?php }?>
                <?php } ?>
            </table>
        </div>
    </div>
</form>
<div id="checkedAttr" class="hide" >
    <table class="detail-list" style="width: 400px;">
        <tr>
            <th>糖</th>
            <td>
                <input type="radio" name="itemAttrA" class="inputItemRadio" value="無糖" />無
               <input type="radio" name="itemAttrA" class="inputItemRadio" value="微糖" /> 微
                <input type="radio" name="itemAttrA" class="inputItemRadio" value="中糖" />中
                <input type="radio" name="itemAttrA" class="inputItemRadio" value="少糖" />少
                <input type="radio" name="itemAttrA" def="me" class="inputItemRadio" checked="checked" value="正糖" />正
            </td>
        </tr>
        <tr>
            <th>冰</th>
            <td>
                <input type="radio" name="itemAttrB" class="inputItemRadio" value="無冰" />無
                <input type="radio" name="itemAttrB" class="inputItemRadio" value="微冰" />微
                <input type="radio" name="itemAttrB" class="inputItemRadio" value="中冰" />中
                <input type="radio" name="itemAttrB" class="inputItemRadio" value="少冰" />少
                <input type="radio" name="itemAttrB" def="me" class="inputItemRadio" checked="checked" value="正冰" />正<br/><br/><br/>
                <input type="radio" name="itemAttrB" class="inputItemRadio" checked="checked" value="溫" />溫
                <input type="radio" name="itemAttrB" class="inputItemRadio" checked="checked" value="熱" />熱
            </td>
        </tr>
        <tr>
            <td colspan="2" >
                <input type="button" id="addItemBtn" value="確認" />
            </td>
        </tr>
    </table>
</div>