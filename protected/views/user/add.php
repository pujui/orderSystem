<?php
$editStatus = 0;
if(isset($editUserVO)){
    $isActive = $editUserVO->isActive;
    $editStatus = 1;
}
?>
<form id="userAddForm" method="post" >
    <table>
        <tr>
            <th colspan="2" class="subTitle"><?php if($editStatus){?>編輯帳號<?php }else{ ?>新增帳號<?php } ?></th>
        </tr>
        <tr  >
            <td>Name</td>
            <td >
                <?php if($editStatus){?>
                    <input type="hidden" name="edit" value="1" />
                    <input type="text" name="name" value="<?=CHtml::encode($editUserVO->name)?>" maxlength="40"/>
                <?php }else{ ?>
                <input type="text" name="name" maxlength="40"/>
                <?php } ?>
            </td>
        </tr>
        <tr class="odd-row">
            <td >Account</td>
            <td >
                <?php if($editStatus){
                    echo CHtml::encode($editUserVO->account);
                }else{ ?>
                <input type="text" name="account" maxlength="40"/>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><?php if($editStatus){ echo "Change "; }?>Password</td>
            <td >
                <input type="password" name="password" maxlength="20" />
            </td>
        </tr>
        <tr class="odd-row">
            <td>Confirm Password</td>
            <td >
                <input type="password" name="confirmPassword" maxlength="20" />
            </td>
        </tr>
        <tr>
            <td >isActive</td>
            <td >
                <select name="isActive" class="btn-lg" >
                    <option value="0" <?php if($isActive=='0') echo 'selected="selected"'; ?> >close</option>
                    <option value="1" <?php if($isActive=='1') echo 'selected="selected"'; ?> >normal</option>
                    <option value="2" <?php if($isActive=='2') echo 'selected="selected"'; ?> >root</option>
                    <option value="-1" <?php if($isActive=='-1') echo 'selected="selected"'; ?> >delete</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <div class="btn-group btn-group-lg" role="group" >
                    <?php if(is_object($userAddFormVO) && $userAddFormVO->errorCode > 0): ?>
                    <span class="error" >ERROR CODE：<?=$userAddFormVO->errorCode ?></span><br/>
                    <?php endif; ?>
                    <button class="btn btn-lg btn-primary btn-block loginSubmit" type="submit">提交</button>
                </div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var userAddFormVO = <?=json_encode($userAddFormVO); ?>;
</script>