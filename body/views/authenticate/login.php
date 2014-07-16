<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#login").validate();
    });
    //]]>
</script>
<div class="alert alert-warning alert-bold-border fade in alert-dismissable" >
    Benvenuto su MyLudosport, per accedere inserisci le tue credenziali.</div>
<form role="form" action="<?php echo base_url() . 'validate'; ?>" id="login" method="post">
    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="text" class="form-control no-border input-lg rounded required" placeholder="Enter username" autofocus name="username">
        <span class="fa fa-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="password" class="form-control no-border input-lg rounded required" placeholder="Enter password" name="password">
        <span class="fa fa-unlock-alt form-control-feedback"></span>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" class="i-yellow-flat"> Remember me
            </label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block">LOGIN</button>
    </div>
</form>
<p class="text-center"><strong><a href="forgot-password.html">Hai perso la password?</a></strong></p>
<p class="text-center">or</p>
<p class="text-center"><strong><a href="register.html">Create new account</a></strong></p>