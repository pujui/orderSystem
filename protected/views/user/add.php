<form id="detailForm" method="post">
    <table style="width: 500px;">
        <tr>
            <th >Name</th>
            <td >
                <input type="text" name="name" maxlength="40"/>
            </td>
        </tr>
        <tr>
            <th >Account</th>
            <td >
                <input type="text" name="account" maxlength="40"/>
            </td>
        </tr>
        <tr>
            <th>Password</th>
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
                    <option value="0" >close</option>
                    <option value="1" >normal</option>
                    <option value="2" >power</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" />
            </td>
        </tr>
    </table>
    <?php if(is_object($userAddFormVO)): ?>
    <span class="error" >ERROR CODE：<?=$userAddFormVO->errorCode ?></span>
    <?php endif; ?>
</form>
<script type="text/javascript">
    var userAddFormVO = <?=json_encode($userAddFormVO); ?>;
</script>