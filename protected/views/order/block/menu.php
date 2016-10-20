<div id="addMenu" >
    <div class="scroll" >
        <table >
        <tr>
            <th colspan="2" >菜單內容</th>
        </tr>
            <?php
            $trCount = 0;
            foreach ($showList as $className=>$menuList){
                foreach ($menuList as $key=>$row){ 
                    foreach ($row['priceList'] as $priceRow){
                        if($trCount%2 == 0){
                            echo '<tr>';
                        }
                        echo '<td>';
                        echo sprintf('<input type="button"
                                        value="%s %s : %d"
                                        class="addItem"
                                        data-nameid="%s"
                                        data-name="%s"
                                        data-classname="%s"
                                        data-price="%d"
                                     />'
                                    , CHtml::encode($row['name']) , CHtml::encode($priceRow[0]), CHtml::encode($priceRow[1])
                                    , CHtml::encode($row['menuId'])
                                    , CHtml::encode($row['name'])
                                    , CHtml::encode($priceRow[0])
                                    , CHtml::encode($priceRow[1]));
                        echo '</td>';
                        if(($trCount+1)%2 == 0){
                            echo '</tr>';
                        }
                        $trCount++;
                    }
                }
            }
            if(($trCount-1)%2 == 0){
                echo '<td></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>