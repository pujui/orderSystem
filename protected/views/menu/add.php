<form id="addMenu" method="post" >
    <table >
        <tr>
            <th colspan="2" class="subTitle"><?php if(!empty($menuData)){?>編輯商品<?php }else{ ?>新增商品<?php } ?></th>
        </tr>
        <tr>
            <th >名稱</th>
            <td style="text-align: left; padding: 20px;">
                <input type="text" name="name" value="<?=CHtml::encode($menuData['name']) ?>" maxlength="40"/>
            </td>
        </tr>
        <tr>
            <th >分類</th>
            <td style="text-align: left; padding: 20px;">已有分類
                <select name="defFirstClass" class="btn-lg" >
                    <option value="-999" >--</option>
                    <?php foreach ($firstClassList as $key=>$row ){ ?>
                    <option ><?=CHtml::encode($row['firstClass']) ?></option>
                    <?php } ?>
                </select>
                <input type="text" name="firstClass" value="<?=CHtml::encode($menuData['firstClass']) ?>" placeholder="手動建立請勿選擇上方選項" maxlength="40"/>
            </td>
        </tr>
        <tr>
            <th >販賣狀態</th>
            <td style="text-align: left; padding: 20px;">
                <select name="isCancel" class="btn-lg" >
                    <option value="0" <?php if($menuData['isCancel']=='0') echo 'selected="selected"'; ?>>正常販賣</option>
                    <option value="1" <?php if($menuData['isCancel']=='1') echo 'selected="selected"'; ?>>暫時取消</option>
                    <option value="-1" <?php if($menuData['isCancel']=='-1') echo 'selected="selected"'; ?> >刪除</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                1.<input type="text" name="className[]" value="小" maxlength="10" width="20px" /> <input type="text" name="classPrice[]" maxlength="10" width="20px" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                2.<input type="text" name="className[]" value="中" maxlength="10" width="20px" /> <input type="text" name="classPrice[]" maxlength="10" width="20px" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                3.<input type="text" name="className[]" value="大" maxlength="10" width="20px" /> <input type="text" name="classPrice[]" maxlength="10" width="20px" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                4.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                5.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" />
            </td> 
        </tr>
        <tr>
            <td colspan="2">
                6.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" />
            </td> 
        </tr>
        <tr>
            <td colspan="2">
                7.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" />
             </td> 
        </tr>
        <tr>
            <td colspan="2">
                8.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" />
            </td> 
        </tr>
        <tr>
            <td colspan="2">
                9.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" />
            </td> 
        </tr>
        <tr>
            <td colspan="2">
                10.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" />
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <div class="btn-group btn-group-lg" role="group" >
                    <button class="btn btn-lg btn-primary btn-block loginSubmit" type="submit">提交</button>
                </div>
            </td>
        </tr>
    </table>
    <?php if($errorCode > 0): ?>
    <span class="error" >ERROR CODE：<?=$errorCode ?></span>
    <?php endif; ?>
</form>
<script type="text/javascript">
var priceList = <?=json_encode($priceList) ?>;
if(priceList){
    for(var i in priceList){
        $('input[name="className[]"]').eq(i-1).val(priceList[i][0]);
        if(priceList[i][1] > 0){
            $('input[name="classPrice[]"]').eq(i-1).val(priceList[i][1]);
        }
    }
}
</script>