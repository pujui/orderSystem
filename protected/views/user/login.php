<div id="login">
    <h1>Sign in with your Account</h1>
    <form id="loginForm" method="post" >
        <ul>
            <li class="title"><label for="account">Account</label></li>
            <li><input type="text" name="account" id="account" placeholder="Account" /></li>
            <li class="title"><label for="password" >Password</label></li>
            <li><input type="password" name="password" id="password" placeholder="Password" /></li>
            <li><input type="submit" name="loginSubmit" id="loginSubmit" value="Sign in" /></li>
            <li><span class="error" >帳號密碼錯誤</span></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
var loginFormVO = <?=json_encode($loginFormVO) ?>;
</script>