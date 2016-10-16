<?php
$editStatus = 0;
if(isset($editUserVO)){
    $isActive = $editUserVO->isActive;
    $editStatus = 1;
}
?>
<form id="detailForm" method="post" >
    <table style="width: 500px;">
        <tr>
            <th >Name</th>
            <td >
                <?php if($editStatus){?>
                    <input type="hidden" name="edit" value="1" />
                    <input type="text" name="name" value="<?=CHtml::encode($editUserVO->name)?>" maxlength="40"/>
                <?php }else{ ?>
                <input type="text" name="name" maxlength="40"/>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th >Account</th>
            <td >
                <?php if($editStatus){
                    echo CHtml::encode($editUserVO->account);
                }else{ ?>
                <input type="text" name="account" maxlength="40"/>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th><?php if($editStatus){ echo "Change "; }?>Password</th>
            <td >
                <input type="password" name="password" maxlength="20" />
            </td>
        </tr>
        <tr>
            <th>Confirm Password</th>
            <td >
                <input type="password" name="confirmPassword" maxlength="20" />
            </td>
        </tr>
        <tr>
            <th >isActive</th>
            <td >
                <select name="isActive" >
                    <option value="0" <?php if($isActive=='0') echo 'selected="selected"'; ?> >close</option>
                    <option value="1" <?php if($isActive=='1') echo 'selected="selected"'; ?> >normal</option>
                    <option value="2" <?php if($isActive=='2') echo 'selected="selected"'; ?> >root</option>
                    <option value="-1" <?php if($isActive=='2') echo 'selected="selected"'; ?> >delete</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" />
            </td>
        </tr>
    </table>
    <?php if(is_object($userAddFormVO) && $userAddFormVO->errorCode > 0): ?>
    <span class="error" >ERROR CODE：<?=$userAddFormVO->errorCode ?></span>
    <?php endif; ?>
</form>
<script type="text/javascript">
    var userAddFormVO = <?=json_encode($userAddFormVO); ?>;
</script>