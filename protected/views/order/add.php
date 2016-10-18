<div id="tabs">
    <ul>
        <li><a href="#tabs-1">菜單內容</a></li>
        <li><a href="#tabs-2" class="orderTab" >訂單內容</a></li>
    </ul>
    <form id="addOrderForm" method="post" style="height:600px;" >
        <div>
            <div id="tabs-2" style="height:600px; overflow:scroll;">
                <table style="width: 500px;">
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
                            <br/><input type="submit" style="width: 200px;height: 50px; margin-bottom:10px;" value="列印並送出訂單" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-1" style="height:600px; overflow:scroll;" >
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
                <th>冰</th>
                <td><input type="radio" name="itemAttrB" def="me" class="inputItemRadio" checked="checked" value="正常" />正常</td>
                <td><input type="radio" name="itemAttrB" class="inputItemRadio" checked="checked" value="去冰" />去冰</td>
                <td><input type="radio" name="itemAttrB" class="inputItemRadio" checked="checked" value="微冰" />微冰</td>
                <td><input type="radio" name="itemAttrB" class="inputItemRadio" checked="checked" value="少冰" />少冰</td>
                <td><input type="radio" name="itemAttrB" class="inputItemRadio" checked="checked" value="多冰" />多冰</td>
            </tr>
            <tr>
                <th>糖</th>
                <td><input type="radio" name="itemAttrA" def="me" class="inputItemRadio" checked="checked" value="正常" />正常</td>
                <td><input type="radio" name="itemAttrA" class="inputItemRadio" checked="checked" value="微糖" />微糖</td>
                <td><input type="radio" name="itemAttrA" class="inputItemRadio" checked="checked" value="半糖" />半糖</td>
                <td><input type="radio" name="itemAttrA" class="inputItemRadio" checked="checked" value="少糖" />少糖</td>
                <td><input type="radio" name="itemAttrA" class="inputItemRadio" checked="checked" value="無糖" />無糖</td>
            </tr>
            <tr>
                <th>其他</th>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="少蜂蜜" />少蜂蜜</td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="去蜂蜜" />去蜂蜜</td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="全奶" />全奶</td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="加蜂蜜" />加蜂蜜</td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="酸一點" />酸一點</td>
            </tr>
            <tr>
                <td></td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="加牛奶" />加牛奶</td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="去布丁" />去布丁</td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="去牛奶" />去牛奶</td>
                <td><input type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="去牛奶10" />去牛奶10</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" >
                    <input type="button" id="addItemBtnAgain" class="inputItemAttrCheck" value="繼續" />
                    <input type="button" id="addItemBtn" class="inputItemAttrCheck" value="確認出單" />
                </td>
            </tr>
        </table>
    </div>
</div>