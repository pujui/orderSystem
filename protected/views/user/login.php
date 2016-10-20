<div id="login" class="container">
    <form id="loginForm" method="post" class="form-signin" role="form" >
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="account" >Account</label>
        <input type="text" id="account" name="account" class="form-control" placeholder="Account" required autofocus />
        <label for="password" >Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
        <button class="btn btn-lg btn-primary btn-block loginSubmit" type="submit">Sign in</button>
    </form>
</div>
<script type="text/javascript">
var loginFormVO = <?=json_encode($loginFormVO) ?>;
</script>