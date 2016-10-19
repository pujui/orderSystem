<footer>
    <div id="footer">
        <input type="button" class="mainBtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" value="建立訂單" />
        <input type="button" class="mainBtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/index';" value="訂單管理" />
        <input type="button" class="mainBtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/index';" value="使用者管理" />
        <input type="button" class="mainBtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/menu/index';" value="菜單管理" />
        <?php if($isLogin === true){ ?>
        <input type="button" id="logoutBtn"  class="mainBtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/logout';" value="登出<?=$user->account ?>" />
        <?php }else{ ?>
        <input type="button" id="loginBtn" class="mainBtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/login';" value="登入" />
        <?php } ?>
    </div>
</footer>