
<form method="post" action="{{ wp_login_url($_SERVER["REQUEST_URI"]) }}" class="login-form">
    <div class="form-group">
        <label for="login-username"><?php _e('Username'); ?></label>
        <input type="text" name="log" id="login-username">
    </div>
    <div class="form-group">
        <label for="login-password"><?php _e('Password'); ?></label>
        <input type="password" name="pwd" id="login-password">
    </div>
    <div class="form-group">
        <label class="checkbox">
            <input id="rememberme" type="checkbox" value="forever" name="rememberme">
            <?php _e('Remember Me'); ?>
        </label>
    </div>
    <div class="form-group">

        <input type="hidden" name="use_sso" value="false">

        <input type="submit" class="btn btn-primary" value="<?php _e('Login', 'elevroden'); ?>">
    </div>

    <input type="hidden" name="_ad_nonce" value="{{ md5(NONCE_KEY."ad".date("Ymd")) }}"/>
    {!! wp_referer_field(false) !!}
</form>
