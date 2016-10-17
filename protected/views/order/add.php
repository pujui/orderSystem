<form id="detailForm" method="post" >
    <div>
        <div style="float: left;">
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
                        <input type="button" style="width: 100px;height: 50px; margin-bottom:5px;" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" value="清除" />
                        <input type="submit" style="width: 200px;height: 50px;" value="列印並送出訂單" />
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