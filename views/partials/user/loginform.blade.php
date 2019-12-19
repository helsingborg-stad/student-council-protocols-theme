
<?php
$redirect_url = wp_login_url($_SERVER["REQUEST_URI"]);
    wp_login_form(
        array(
            'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            'label_username' => __('Username'),
            'label_password' => __('Password')
        )
    );
?>
