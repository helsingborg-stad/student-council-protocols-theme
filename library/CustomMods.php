<?php

namespace Elevroden;

class CustomMods
{
    public function __construct()
    {
        $this->postTypeSlug = 'protocol';

        update_option('options_mod_form_crypt', false);

        add_filter('Municipio/blog/post_settings', array($this, 'modularityMod'), 10, 2);
        add_filter('wp_nav_menu_args', array($this, 'display_wp_nav_menu_args'));
        add_filter('walker_nav_menu_start_el', array($this, 'modify_login_item'), 10, 2);
        add_filter('login_form_bottom', array($this, 'ad_nonce_field'));
        add_action('wp_logout', array($this, 'logout_redirect'));
        add_filter('wp_nav_menu_objects', array($this,'remove_logout_confirmation'));
        add_filter('adApiWpIntegration/login/editorRedirect', array($this, 'ad_redirect'));
    }

    public function modularityMod($items, $post)
    {
        $formData = get_post_meta($post->ID, 'form-data')[0];
    
        $items['site_url'] = get_home_url();
        $items['subjects'] = $formData['valj-amnen-kategorier'];
        $items['header_image'] = $formData['ladda-upp-en-header-bild'] ? $items['site_url'] . '/wp-content' . explode('wp-content', $formData['ladda-upp-en-header-bild'][0])[1] : $formData['ladda-upp-en-header-bild'];
        $items['gallery_images'] = $formData['ladda-upp-en-eller-flera-galleri-bilder'];
        $items['attachments'] = $formData['ladda-up-en-eller-flera-filer'];
        $items['currentUserId'] = get_current_user_id();

        return $items;
    }

    public function display_wp_nav_menu_args($args)
    {
        if (is_user_logged_in()) {
            $args['menu'] = 'logged-in';
        } else {
            $args['menu'] = 'logged-out';
        }
        return $args;
    }

    public function modify_login_item($item_output, $item)
    {
        if ($item->url == '#login') {
            $item_output = '<a href="#" data-dropdown=".login-dropdown" class="">Logga in <i class="fa fa-caret-down"></i></a>';
        }
        return $item_output;
    }

    public function ad_nonce_field()
    {
        $adNonce = md5(NONCE_KEY."ad".date("Ymd"));
        return '<input type="hidden" name="_ad_nonce" value="'.$adNonce.'"/>';
    }

    public function logout_redirect()
    {
        wp_redirect(get_home_url() . '/protocol');
        exit();
    }

    public function remove_logout_confirmation($items)
    {
        foreach ($items as $item) {
            if (strpos($item->url, 'logout') !== false) {
                $item->url = $item->url . "&_wpnonce=" . wp_create_nonce('log-out');
            }
        }
        return $items;
    }

    public function ad_redirect($redirectUrl) {
        return $redirectUrl . '/protocol';
    }
}
