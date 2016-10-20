<form id="addOrderForm" method="post" >
        <?php include dirname(__FILE__).'/block/order.php'; ?>
        <?php include dirname(__FILE__).'/block/menu.php'; ?>
</form>
<div id="checkedAttr" class="hide" >
    <table class="checkedAttr" >
        <tr>
            <th>冰</th>
            <td>
                <table>
                <?php
                foreach ($extraMenuList['ice'] as $extraKey=>$extraRow){
                    if($extraKey%5==0){
                        echo '<tr>';
                    }
                    $selected = ($extraRow[1] == 1)? 'def="me"': 'checked="checked"';
                    echo sprintf('<td><label for="itemAttrB%d"><input type="radio" id="itemAttrB%d"  %s  name="itemAttrB" class="inputItemRadio" value="%s" />%s</label></td>',
                            $extraKey, $extraKey
                            , $selected
                            , CHtml::encode($extraRow[0])
                            , CHtml::encode($extraRow[0])
                        );
                    if($extraKey%5==4){
                        echo '</tr>';
                    }
                }
                if($extraKey%5!=4){
                    echo '</tr>';
                }
                ?>
                </table>
            </td>
        </tr>
        <tr>
            <th>糖</th>
            <td >
                <table>
                <?php
                foreach ($extraMenuList['sugar'] as $extraKey=>$extraRow){
                    if($extraKey%5==0){
                        echo '<tr>';
                    }
                    $selected = ($extraRow[1] == 1)? 'def="me"': 'checked="checked"';
                    echo sprintf('<td><label for="itemAttrA%d"><input type="radio" id="itemAttrA%d"  %s  name="itemAttrA" class="inputItemRadio" value="%s" />%s</label></td>',
                            $extraKey, $extraKey
                            , $selected
                            , CHtml::encode($extraRow[0])
                            , CHtml::encode($extraRow[0])
                        );
                    if($extraKey%5==4){
                        echo '</tr>';
                    }
                }
                if($extraKey%5!=4){
                    echo '</tr>';
                }
                ?>
                </table>
            </td>
        </tr>
        <?php if(!empty($extraMenuList['extra'])){ ?>
        <tr>
            <th>其他</th>
            <td>
                <table>
                <?php
                foreach ($extraMenuList['extra'] as $extraKey=>$extraRow){
                    if($extraKey%5==0){
                        echo '<tr>';
                    }
                    echo sprintf('<td><label for="itemAttrC%d"><input id="itemAttrC%d" type="checkbox" name="itemAttrC[]" class="inputItemRadio" value="%s" data-price="%d" />%s</label></td>',
                            $extraKey, $extraKey
                            , CHtml::encode($extraRow[0])
                            , CHtml::encode($extraRow[1])
                            , CHtml::encode($extraRow[0])
                        );
                    if($extraKey%5==4){
                        echo '</tr>';
                    }
                }
                if($extraKey%5!=4){
                    echo '</tr>';
                }
                ?>
                </table>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="6" >
                <input type="button" id="addItemBtn" class="inputItemAttrCheck" value="確認" />
                <input type="button" id="cancelItemBtn" class="inputItemAttrCheck" value="取消" />
            </td>
        </tr>
    </table>
</div>