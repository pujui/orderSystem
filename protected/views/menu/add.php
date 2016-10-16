<form id="detailForm" method="post" >
    <table style="width: 500px;">
        <tr>
            <th >名稱</th>
            <td >
                <input type="text" name="name" value="<?=CHtml::encode($menuData['name']) ?>" maxlength="40"/>
            </td>
        </tr>
        <tr>
            <th >分類</th>
            <td >選擇目前已有分類
                <select name="defFirstClass" >
                    <option value="-999" >--</option>
                    <?php foreach ($firstClassList as $key=>$row ){ ?>
                    <option ><?=CHtml::encode($row['firstClass']) ?></option>
                    <?php } ?>
                </select><br/><br/>
                <input type="text" name="firstClass" value="<?=CHtml::encode($menuData['firstClass']) ?>" placeholder="手動建立請勿選擇上方選項" maxlength="40"/>
            </td>
        </tr>
        <tr>
            <th >販賣狀態</th>
            <td >
                <select name="isCancel" >
                    <option value="0" <?php if($menuData['isCancel']=='0') echo 'selected="selected"'; ?>>正常販賣</option>
                    <option value="1" <?php if($menuData['isCancel']=='1') echo 'selected="selected"'; ?>>暫時取消</option>
                    <option value="-1" <?php if($menuData['isCancel']=='-1') echo 'selected="selected"'; ?> >刪除</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;" >
                1.<input type="text" name="className[]" value="小" maxlength="10" width="20px" /> <input type="text" name="classPrice[]" maxlength="10" width="20px" /><br/>
                2.<input type="text" name="className[]" value="中" maxlength="10" width="20px" /> <input type="text" name="classPrice[]" maxlength="10" width="20px" /><br/>
                3.<input type="text" name="className[]" value="大" maxlength="10" width="20px" /> <input type="text" name="classPrice[]" maxlength="10" width="20px" /><br/>
                4.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" /><br/>
                5.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" /><br/>
                6.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" /><br/>
                7.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" /><br/>
                8.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" /><br/>
                9.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" /><br/>
                10.<input type="text" name="className[]" placeholder="品項: 小 中 大" maxlength="10" width="20px" /> <input type="text" placeholder="價格: 30 45 50" name="classPrice[]" maxlength="10" width="20px" /><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" />
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